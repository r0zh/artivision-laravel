<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                'path' => 'images/johndoe/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 1,
                'path' => 'images/johndoe/512x512.png',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 1,
                'path' => 'images/johndoe/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],

            [
                'user_id' => 1,
                'path' => 'images/johndoe/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 1,
                'path' => 'images/johndoe/512x512.png',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,

            ],

            [
                'user_id' => 2,
                'path' => 'images/janedoe/512x768.png',
                'seed' => 1234567,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,
            ],
            [
                'user_id' => 2,
                'path' => 'images/janedoe/512x512.png',
                'seed' => 123456,
                'positivePrompt' => 'This is a positive prompt.',
                'negativePrompt' => 'This is a negative prompt.',
                'public' => true,

            ],

        ]);

        Storage::disk('public')->makeDirectory('images/johndoe');
        Storage::disk('public')->put('images/johndoe/512x512.png', file_get_contents('https://via.placeholder.com/512x512.png'));
        Storage::disk('public')->put('images/johndoe/512x768.png', file_get_contents('https://via.placeholder.com/512x768.png'));

        Storage::disk('public')->makeDirectory('images/janedoe');
        Storage::disk('public')->put('images/janedoe/512x512.png', file_get_contents('https://via.placeholder.com/512x512.png'));
        Storage::disk('public')->put('images/janedoe/512x768.png', file_get_contents('https://via.placeholder.com/512x768.png'));

    }
}
