<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Carbon;

class MainController extends Controller
{
    public static function getTranslators()
    {
        $translators = DatabaseController::getTranslators();

        return self::getAdditionalInfoForTranslator($translators);
    }

    public static function getTranslatorsByName($name)
    {
        $translators = DatabaseController::getTranslatorByName($name);

        return self::getAdditionalInfoForTranslator($translators);
    }

    public static function getTranslatorById($id)
    {
        $translator = DatabaseController::getTranslatorById($id);

        return self::getAdditionalInfoForTranslator(collect([$translator]))->first();
    }

    private static function getAdditionalInfoForTranslator($translators)
    {
        $today = Carbon::today()->toDateString();

        // For each translator, get their services with language info
        foreach ($translators as $translator) {
            $translator->services = DatabaseController::getTranslatorServices($translator->id);

            // Check if translator has any bookings today
            $hasBookingToday = DatabaseController::checkTranslatorHasBookingByDate($translator->id, $today);

            // Add property to indicate availability
            $translator->is_available = !$hasBookingToday;
        }

        return $translators;
    }

    public static function filterTranslators($date, $language1, $language2, $rating, $availableOnly)
    {
        $translators = self::getTranslators();

        // Filter by rating
        if ($rating != null) {
            $translators = self::filterByRating($translators, $rating);
        }

        // Filter by service languages (position-independent)
        if ($language1 != null || $language2 != null) {
            $translators = self::filterByLanguages($translators, $language1, $language2);
        }

        // Filter by availability on date only
        if ($date != null) {
            $translators = self::filterByDate($translators, $date);
        }

        // Filter by availableOnly (show only available translators on the selected date)
        if ($availableOnly != null) {
            $translators = self::filterByAvailableOnly($translators);
        }

        return $translators;
    }

    private static function filterByRating($translators, $rating)
    {
        $result = [];

        foreach ($translators as $translator) {
            if ($translator->rating >= $rating) {
                $result[] = $translator;
            }
        }

        return collect($result)->values();
    }

    private static function filterByLanguages($translators, $language1, $language2)
    {
        $result = [];

        foreach ($translators as $translator) {
            foreach ($translator->services as $service) {

                $lang1Id = $service->language1_id;
                $lang2Id = $service->language2_id;

                if ($language1 && $language2) {
                    $langCon1 = $lang1Id == $language1 && $lang2Id == $language2;
                    $langCon2 = $lang1Id == $language2 && $lang2Id == $language1;

                    if ($langCon1 || $langCon2) {
                        $result[] = $translator;
                        break;
                    }
                } elseif ($language1) {
                    $lang1Con = $lang1Id == $language1 || $$lang2Id == $language1;
                    if ($lang1Con) {
                        $result[] = $translator;
                        break;
                    }
                } elseif ($language2) {
                    $lang2Con = $lang1Id == $language2 || $lang2Id == $language2;
                    if ($lang2Con) {
                        $result[] = $translator;
                        break;
                    }
                }
            }
        }
        return collect($result)->values();
    }

    private static function filterByDate($translators, $date)
    {
        $result = [];

        foreach ($translators as $translator) {
            $hasBooking = DatabaseController::checkTranslatorHasBookingByDate($translator->id, $date);
            // Add a property for availability on the selected date
            $translator->is_available = !$hasBooking;
            $result[] = $translator;
        }

        return collect($result)->values();
    }

    private static function filterByAvailableOnly($translators)
    {
        $result = [];

        foreach ($translators as $translator) {
            if ($translator->is_available ?? true) {
                $result[] = $translator;
            }
        }

        return collect($result)->values();
    }

    public static function getLanguages()
    {
        return DatabaseController::getLanguages();
    }

    public static function createBooking($translator_id, $date, $start_time, $duration_hrs, $duration_mins, $location, $service_id)
    {
        // Check if the translator already has a booking at this date and time
        $hasBooking = DatabaseController::checkTranslatorHasBookingByDate($translator_id, $date);

        if ($hasBooking != null) {
            return false;
        }

        $user_id = Auth()->user()->id;

        $result = DatabaseController::saveBooking(
            $translator_id,
            $user_id,
            $date,
            $start_time,
            $duration_hrs,
            $duration_mins,
            $location,
            $service_id
        );

        return $result;
    }
}
