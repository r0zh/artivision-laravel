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
                'path' => 'https://placehold.co/512x768',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
            ],
            [
                'user_id' => 1,
                'path' => 'https://placehold.co/512x512',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',

            ],
            [
                'user_id' => 1,
                'path' => 'https://placehold.co/768x512',
                'seed' => 12345,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',

            ],
            [
                'user_id' => 2,
                'path' => 'https://placehold.co/512x768',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
            ],
            [
                'user_id' => 2,
                'path' => 'https://placehold.co/512x512',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',

            ],
            [
                'user_id' => 2,
                'path' => 'https://placehold.co/768x512',
                'seed' => 12345,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',

            ],
        ]);
    }
}
