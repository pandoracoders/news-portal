<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class ImageUpload
{
    public static function upload($file)
    {
        $path = ("uploads/" . date("Y/m/d/"));
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $filename = \Str::slug(explode(".", $file->getClientOriginalName())[0]);
        // Intervention
        $path = $path . time() . "_" .  $filename . '.webp';
        Image::make($file)->encode('webp', 90)->save(($path));

        return $path;
    }
}
