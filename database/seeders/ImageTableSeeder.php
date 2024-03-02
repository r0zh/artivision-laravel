<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('image')->insert([
            [
                'user_id' => 1,
                'path' => 'storage/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 1,
                'path' => 'storage/512x512.png',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 1,
                'path' => 'storage/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],

            [
                'user_id' => 1,
                'path' => 'storage/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 1,
                'path' => 'storage/512x512.png',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,

            ],

            [
                'user_id' => 2,
                'path' => 'storage/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 2,
                'path' => 'storage/512x512.png',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,

            ],

        ]);
    }
}
