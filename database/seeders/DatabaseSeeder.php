<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Service;
use App\Models\Translator;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            'rating' => 5,
            'status' => 1,
        ]);

        Translator::create([
            'name' => 'Katrina Johnson',
            'email' => 'katrina@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/360_F_769911335_41nhzSbUxD0NfmpRJLraT5xZMoqcsICt.jpg',
            'rating' => 3.1,
            'status' => 1,
        ]);

        Translator::create([
            'name' => 'Emily Davis',
            'email' => 'emily@example.com',
            'password' => Hash::make('password'),
            'profile' => 'public/img/translators/2c8ce3fd1b6c93c7ac4fa271e638329c.jpg',
            'rating' => 4.7,
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

        Service::create([
            'translator_id' => 1,
            'language1_id' => 1,
            'language2_id' => 2,
            'price' => 350,
        ]);

        Service::create([
            'translator_id' => 1,
            'language1_id' => 1,
            'language2_id' => 3,
            'price' => 400,
        ]);
    }
}
