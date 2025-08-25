<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EnDe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function search()
    {
        $translators = MainController::getTranslators();

        $languages = MainController::getLanguages();

        return view('search', ['translators' => $translators, 'languages' => $languages]);
    }

    public function searchByName(Request $request)
    {
        $search = $request->input('search');

        $translators = MainController::getTranslatorsByName($search);

        $languages = MainController::getLanguages();

        return view('search', [
            'translators' => $translators,
            'languages' => $languages,
            'search' => $search,
        ]);
    }

    public function filterTranslators(Request $request)
    {
        $date = $request->input('date');
        $language1 = $request->input('language1');
        $language2 = $request->input('language2');
        $rating = $request->input('rating');
        $availableOnly = $request->input('available_only');

        $languages = MainController::getLanguages();

        $translators = MainController::filterTranslators($date, $language1, $language2, $rating, $availableOnly);

        return view('search', [
            'translators' => $translators,
            'languages' => $languages,
            'date' => $date,
            'language1' => $language1,
            'language2' => $language2,
            'rating' => $rating,
            'available_only' => $availableOnly,
        ]);
    }

    public function translator_detail($encrypted_id)
    {
        $id = decrypt($encrypted_id);
        $translator = MainController::getTranslatorById($id);
        return view('translator_detail', ['translator' => $translator]);
    }

    public function translator_bookings($translator_id, $date)
    {
        $id = decrypt($translator_id);
        $translator = MainController::getTranslatorById($id);
        return view('booking', ['translator' => $translator, 'date' => $date]);
    }

    public function storeBooking(Request $request)
    {
        $translator_id = $request->input('translator_id');
        $date = $request->input('booking_date');
        $start_time = $request->input('booking_start_time');
        $duration_hrs = $request->input('duration_hrs');
        $duration_mins = $request->input('duration_mins');
        $location = $request->input('location');
        $service_id = $request->input('service_id');

        $result = MainController::createBooking($translator_id, $date,
        $start_time, $duration_hrs, $duration_mins, $location, $service_id);

        if ($result) {
            return redirect()->route('bookings.create', [
                'translator_id' => encrypt($translator_id),
                'date' => $date
            ])->with('success', 'Booking successful!');
        } else {
            return redirect()->route('bookings.create', [
                'translator_id' => encrypt($translator_id),
                'date' => $date
            ])->with('error', 'Booking failed! Translator is not available at the selected date.');
        }
    }
}
