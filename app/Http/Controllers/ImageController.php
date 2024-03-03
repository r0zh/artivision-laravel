<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function getImage($user, $file)
    {
        $id = Str::before($user, '_');
        if ($id == auth()->id()) {
            $file = Storage::disk('local')->get('private_images/'.$user.'/'.$file);
            $type = Storage::mimeType($file);

            $response = Response::make($file, 200);
            $response->header('Content-Type', $type);

            return $response;
        } else {
            abort(404);
        }
    }
}
