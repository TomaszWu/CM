<?php

declare(strict_types=1);

namespace App\Service\File\OutputHandler;

class OutputHandlerFactory
{
    public function getOutputHandler(string $mime): OutputHandlerInterface
    {
        if ('image/jpeg' === $mime) {
            return new JpegOutputHandler();
        }

        if ('image/png' === $mime) {
            return new PngOutputHandler();
        }
    }
}
