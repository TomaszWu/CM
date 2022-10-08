<?php

declare(strict_types=1);

namespace App\Service\File\OutputHandler;

class PngOutputHandler implements OutputHandlerInterface
{
    public function handleFile(\GdImage $image, string $filename): void
    {
        imagepng($image, $filename);
    }
}
