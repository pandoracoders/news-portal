<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class ImageUpload
{
    public static function upload($file, $path = null, $filename = null)
    {
        $path = $path ?? ("uploads/" . date("Y/m/d/"));
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if ($filename == null) {
            $filename = str_slug(explode(".", $file->getClientOriginalName())[0]);
            $path = $path . time() . "_" .  $filename . '.webp';
        } else {
            $path = $path . $filename . '.webp';
        }
        // Intervention
        Image::make($file)->resize(728, 455, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('webp', 60)->save(($path));
        return $path;
    }
}


