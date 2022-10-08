<?php

declare(strict_types=1);

namespace App\Service\File\OutputHandler;

class JpegOutputHandler implements OutputHandlerInterface
{
    public function handleFile(\GdImage $image, string $filename): void
    {
        imagejpeg($image, $filename);
    }
}
