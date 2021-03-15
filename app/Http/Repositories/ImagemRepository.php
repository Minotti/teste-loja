<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagemRepository
{
    public static function upload($foto)
    {
        $name = str_random(30) . '.jpg';
        $path_original = "imagens/" . $name;

        $img = Image::make($foto)->resize(600, 600, function ($constraint) {
            $constraint->upsize();
        })->encode('jpg', 90);

        Storage::disk('public')->put($path_original, $img, 'public');

        $thumb = Image::make($foto)->resize(150, 150, function ($constraint) {
            $constraint->upsize();
        })->encode('jpg', 90);

        Storage::disk('public')->put('thumbs/'.$path_original, $thumb, 'public');

        return $path_original;
    }

    public static function delete($path)
    {
        Storage::disk('public')->delete($path);
        Storage::disk('public')->delete('thumbs/'.$path);
    }
}
