<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Image;

class ImageUpload
{
    // store new image
    public static function store($imgProps)
    {
        $file = $imgProps['file'];

        // resize the image to a width of $width and constrain aspect ratio (auto $height)
        $img = Image::make($file);

        $width = $imgProps['width'] ?? null;
        $height = $imgProps['height'] ?? null;
        $quality = $imgProps['quality'] ?? 100;

        if ($width != null or $height == null) {
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else if ($width == null or $height != null) {
            $img->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $img->resize($width, $height);
        }

        $file_name = $file->hashName();
        $path = $imgProps['storagePath'] . '/' . $file_name;
        $img->save(public_path($path), $quality, "webp");

        $fileInformation = [
            'original_name' => $file->getClientOriginalName(),
            'file_name' => $file_name,
            'file_extension' => $file->extension(),
            'file_size' => $file->getSize(),
            'file_path' => $path,
        ];

        return $fileInformation;
    }

    // update existing file
    public static function update($imgProps)
    {
        ImageUpload::delete($imgProps);
        $fileInformation = ImageUpload::store($imgProps);

        return $fileInformation;
    }

    // remove existing image
    public static function delete($imgProps)
    {
        $oldFilePath = $imgProps['old_image'];
        $default = $imgProps['default'];

        if (File::exists($oldFilePath) and !strpos($default, "default.")) {
            @unlink(public_path($oldFilePath));
        }
    }
}
