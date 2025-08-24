<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Language;
use App\Models\Service;
use App\Models\Translator;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Lang;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/users/user1Profile.webp',
        ]);

        Translator::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/anime-boy-pfp.webp',
            'gender' => 1,
            'rating' => 5,
            'status' => 1,
        ]);

        Translator::create([
            'name' => 'Katrina Johnson',
            'email' => 'katrina@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/360_F_769911335_41nhzSbUxD0NfmpRJLraT5xZMoqcsICt.jpg',
            'gender' => 2,
            'rating' => 3.1,
            'status' => 1,
        ]);

        Translator::create([
            'name' => 'Emily Davis',
            'email' => 'emily@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/2c8ce3fd1b6c93c7ac4fa271e638329c.jpg',
            'gender' => 2,
            'rating' => 4.7,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Michael Brown',
            'email' => 'michael@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/3.jpeg',
            'gender' => 1,
            'rating' => 4.2,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Sarah Lee',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/4.jpeg',
            'gender' => 2,
            'rating' => 4.9,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'David Kim',
            'email' => 'david@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/5.jpeg',
            'gender' => 1,
            'rating' => 3.8,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Anna Chen',
            'email' => 'anna@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/6.jpeg',
            'gender' => 2,
            'rating' => 4.5,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'James Wilson',
            'email' => 'james@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/7.jpeg',
            'gender' => 1,
            'rating' => 4.0,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Maria Garcia',
            'email' => 'maria@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/8.jpeg',
            'gender' => 2,
            'rating' => 4.6,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Robert Martinez',
            'email' => 'robert@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/9.jpeg',
            'gender' => 1,
            'rating' => 3.5,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Linda Clark',
            'email' => 'linda@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/10.jpeg',
            'gender' => 2,
            'rating' => 4.3,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'William Young',
            'email' => 'william@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/11.jpeg',
            'gender' => 1,
            'rating' => 4.1,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Jessica King',
            'email' => 'jessica@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/12.jpeg',
            'gender' => 2,
            'rating' => 4.8,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Daniel Wright',
            'email' => 'daniel@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/13.jpeg',
            'gender' => 1,
            'rating' => 3.9,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Sophia Lopez',
            'email' => 'sophia@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/14.jpeg',
            'gender' => 2,
            'rating' => 4.4,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Matthew Hill',
            'email' => 'matthew@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/15.jpeg',
            'gender' => 1,
            'rating' => 4.0,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Olivia Scott',
            'email' => 'olivia@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/16.jpeg',
            'gender' => 2,
            'rating' => 4.7,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Joshua Green',
            'email' => 'joshua@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/17.jpeg',
            'gender' => 1,
            'rating' => 3.7,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Chloe Adams',
            'email' => 'chloe@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/18.jpeg',
            'gender' => 2,
            'rating' => 4.6,
            'status' => 1,
        ]);
        Translator::create([
            'name' => 'Benjamin Baker',
            'email' => 'benjamin@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/1.jpeg',
            'gender' => 1,
            'rating' => 4.2,
            'status' => 1,
        ]);

        Language::create([
            'language' => 'English',
            'code' => 'en',
        ]);
        Language::create([
            'language' => 'Thai',
            'code' => 'th',
        ]);
        Language::create([
            'language' => 'Korean',
            'code' => 'ko',
        ]);
        Language::create([
            'language' => 'Chinese',
            'code' => 'zh',
        ]);
        Language::create([
            'language' => 'Japanese',
            'code' => 'ja',
        ]);
        Language::create([
            'language' => 'Spanish',
            'code' => 'es',
        ]);
        Language::create([
            'language' => 'French',
            'code' => 'fr',
        ]);
        Language::create([
            'language' => 'German',
            'code' => 'de',
        ]);

        $translatorIds = Translator::pluck('id')->toArray();
        $languageIds = Language::pluck('id')->toArray();

        foreach ($translatorIds as $translatorId) {
            // Each translator gets 2 services with random language pairs and prices
            for ($i = 0; $i < 2; $i++) {
                $lang1 = Arr::random($languageIds);
                do {
                    $lang2 = Arr::random($languageIds);
                } while ($lang2 == $lang1);

                Service::create([
                    'translator_id' => $translatorId,
                    'language1_id' => $lang1,
                    'language2_id' => $lang2,
                    'price' => rand(300, 500),
                ]);
            }
        }

        $userIds = User::pluck('id')->toArray();
        $translatorIds = Translator::pluck('id')->toArray();
        $serviceIds = Service::pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $userId = Arr::random($userIds);
            $translatorId = Arr::random($translatorIds);
            $serviceId = Arr::random($serviceIds);

            // Random date within the next 30 days
            $bookingDate = now()->addDays(rand(0, 30))->toDateString();

            // Random start time between 8:00 and 18:00
            $hour = rand(8, 18);
            $minute = Arr::random([0, 15, 30, 45]);
            $bookingStartTime = sprintf('%02d:%02d:00', $hour, $minute);

            // Random duration between 0-2 hours and 0-59 minutes
            $durationHrs = rand(0, 2);
            $durationMins = rand(0, 59);

            // Random status (0: pending, 1: confirmed, 2: completed)
            $status = rand(0, 2);

            Booking::create([
                'user_id' => $userId,
                'translator_id' => $translatorId,
                'booking_date' => $bookingDate,
                'booking_start_time' => $bookingStartTime,
                'duration_hrs' => $durationHrs,
                'duration_mins' => $durationMins,
                'status' => $status,
                'service_id' => $serviceId,
            ]);
        }

        $today = now()->toDateString();
        $usedTranslators = [];

        for ($i = 0; $i < rand(4, 5); $i++) {
            // Pick a unique translator for today's booking
            do {
                $translatorId = Arr::random($translatorIds);
            } while (in_array($translatorId, $usedTranslators));
            $usedTranslators[] = $translatorId;

            $userId = Arr::random($userIds);
            // Get a service for this translator
            $serviceId = Service::where('translator_id', $translatorId)->inRandomOrder()->value('id');

            // Random start time between 8:00 and 18:00
            $hour = rand(8, 18);
            $minute = Arr::random([0, 15, 30, 45]);
            $bookingStartTime = sprintf('%02d:%02d:00', $hour, $minute);

            Booking::create([
                'user_id' => $userId,
                'translator_id' => $translatorId,
                'booking_date' => $today,
                'booking_start_time' => $bookingStartTime,
                'duration_hrs' => rand(1, 2),
                'duration_mins' => Arr::random([0, 15, 30, 45]),
                'status' => rand(0, 2),
                'service_id' => $serviceId,
            ]);
        }
    }
}
