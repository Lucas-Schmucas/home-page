<?php

namespace App\Actions\Images;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Interfaces\EncodedImageInterface;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CompressImage
{
    public function execute(UploadedFile|TemporaryUploadedFile $image, int $maxWidth = 400, int $quality = 80): EncodedImageInterface
    {
        return Image::read($image->getRealPath())
            ->scaleDown(width: $maxWidth)
            ->encode(new JpegEncoder(quality: $quality));
    }
}
