<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public static function getTranslators()
    {
        $translators = DB::table('translators')->get();

        return self::getAdditionalInfoForTranslator($translators);
    }

    public static function getTranslatorsByName($name)
    {
        $translators = DB::table('translators')
            ->where('name', 'like', '%' . $name . '%')
            ->get();

        return self::getAdditionalInfoForTranslator($translators);
    }

    public static function getTranslatorById($id)
    {
        $translator = DB::table('translators')->where('id', $id)->first();
        return self::getAdditionalInfoForTranslator(collect([$translator]))->first();
    }

    private static function getAdditionalInfoForTranslator($translators)
    {
        $today = Carbon::today()->toDateString();

        // For each translator, get their services with language info
        foreach ($translators as $translator) {
            $translator->services = DB::table('services')
                ->join('languages as lang1', 'services.language1_id', '=', 'lang1.id')
                ->join('languages as lang2', 'services.language2_id', '=', 'lang2.id')
                ->select([
                    'services.id as service_id',
                    'lang1.language as language1',
                    'lang1.id as language1_id',
                    'lang2.language as language2',
                    'lang2.id as language2_id',
                    'services.price',
                ])
                ->where('services.translator_id', $translator->id)
                ->get();

            // Check if translator has any bookings today
            $hasBookingToday = DB::table('bookings')
                ->where('translator_id', $translator->id)
                ->where('booking_date', $today)
                ->exists();

            // Add property to indicate availability
            $translator->is_available = !$hasBookingToday;
        }

        return $translators;
    }

    public static function filterTranslators($date, $language1, $language2, $rating, $availableOnly)
    {
        $translators = self::getTranslators();

        // Filter by rating
        if ($rating) {
            $translators = $translators->filter(function ($translator) use ($rating) {
                return $translator->rating >= $rating;
            })->values();
        }

        // Filter by service languages (position-independent)
        if ($language1 || $language2) {
            $translators = $translators->filter(function ($translator) use ($language1, $language2) {
                foreach ($translator->services as $service) {
                    if ($language1 && $language2) {
                        if (
                            ($service->language1_id == $language1 && $service->language2_id == $language2) ||
                            ($service->language1_id == $language2 && $service->language2_id == $language1)
                        ) {
                            return true;
                        }
                    } elseif ($language1) {
                        if ($service->language1_id == $language1 || $service->language2_id == $language1) {
                            return true;
                        }
                    } elseif ($language2) {
                        if ($service->language1_id == $language2 || $service->language2_id == $language2) {
                            return true;
                        }
                    }
                }
                return false;
            })->values();
        }

        // Filter by availability on date only
        if ($date) {
            $translators = $translators->filter(function ($translator) use ($date) {
                $hasBooking = DB::table('bookings')
                    ->where('translator_id', $translator->id)
                    ->where('booking_date', $date)
                    ->exists();
                // Add a property for availability on the selected date
                $translator->is_available = !$hasBooking;
                return true; // Don't filter out, just annotate
            })->values();
        }

        // Filter by availableOnly (show only available translators on the selected date)
        if ($availableOnly) {
            $translators = $translators->filter(function ($translator) {
                return $translator->is_available ?? true;
            })->values();
        }

        return $translators;
    }

    public static function getLanguages()
    {
        return DB::table('languages')->get();
    }

    public static function createBooking($translator_id, $date, $start_time, $duration_hrs, $duration_mins, $location, $service_id)
    {
        // Check if the translator already has a booking at this date and time
        $hasBooking = DB::table('bookings')
            ->where('translator_id', $translator_id)
            ->where('booking_date', $date)
            ->exists();

        if ($hasBooking) {
            return false;
        }

        // Store the booking
        DB::table('bookings')->insert([
            'translator_id' => $translator_id,
            'user_id' => auth()->id(),
            'booking_date' => $date,
            'booking_start_time' => $start_time,
            'duration_hrs' => $duration_hrs,
            'duration_mins' => $duration_mins,
            'location' => $location,
            'service_id' => $service_id,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return true;
    }
}
