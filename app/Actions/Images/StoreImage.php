<?php

namespace App\Actions\Images;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Interfaces\EncodedImageInterface;

class StoreImage
{
    public function execute(EncodedImageInterface $image, string $directory, string $extension = 'jpg'): string
    {
        $filename = $directory.'/'.Str::uuid().'.'.$extension;

        Storage::disk('public')->put($filename, (string) $image);

        return $filename;
    }
}
