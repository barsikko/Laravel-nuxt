<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function __invoke(Request $request)
    {
        $file = $request->file('image');
        $name = \Str::random(10);
        $url = \Storage::putFileAs('images', $file, $name . '.' . $file->extension());

        return response()->json(['url' => env('APP_IMAGE_URL').'/'.$url], Response::HTTP_CREATED);
    }
}
