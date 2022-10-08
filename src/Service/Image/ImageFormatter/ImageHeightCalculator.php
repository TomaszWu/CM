<?php

declare(strict_types=1);

namespace App\Service\Image\ImageFormatter;

class ImageHeightCalculator
{
    public function calculateWidth(int $height, int $width, int $desireHeight): int
    {
        return intval($width * $desireHeight / $height);
    }
}
