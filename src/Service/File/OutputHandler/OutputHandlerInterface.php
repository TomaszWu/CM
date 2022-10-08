<?php

namespace App\Service\File\OutputHandler;

interface OutputHandlerInterface
{
    public function handleFile(\GdImage $image, string $filename): void;
}
