<?php

declare(strict_types=1);

namespace App\Service\File\FileHandler;

class DirFileHandler implements FileHandleInterface
{
    public function handleFiles(string $srcDir, string $targetDir, array $files): void
    {
        foreach ($files as $file) {
            copy(__DIR__ . $srcDir . $file, __DIR__ . $targetDir . '/' . $file);
        }
    }
}
