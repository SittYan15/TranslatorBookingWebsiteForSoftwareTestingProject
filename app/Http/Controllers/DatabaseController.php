<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseController
{
    public static function getTranslators()
    {
        return DB::table('translators')->get();
    }

    public static function getTranslatorByName($name)
    {
        return DB::table('translators')
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    public static function getTranslatorById($id)
    {
        return DB::table('translators')->where('id', $id)->first();
    }

    public static function getTranslatorServices($translatorId)
    {
        return DB::table('services')
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
            ->where('services.translator_id', $translatorId)
            ->get();
    }

    public static function checkTranslatorHasBookingByDate($translatorId, $date)
    {
        return DB::table('bookings')
            ->where('translator_id', $translatorId)
            ->where('booking_date', $date)
            ->exists();
    }

    public static function getLanguages()
    {
        return DB::table('languages')->get();
    }

    public static function saveBooking($translator_id, $user_id, $date, $start_time, $duration_hrs, $duration_mins, $location, $service_id)
    {
        DB::table('bookings')->insert([
            'translator_id' => $translator_id,
            'user_id' => $user_id,
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

    public static function createUserAccount($validated)
    {
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile' => 'public/img/users/defaultProfile.avif',
        ]);
    }
}
