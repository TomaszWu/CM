<?php

namespace App\Service\File\FileHandler;

interface FileHandleInterface
{
    public function handleFiles(string $srcDir, string $targetDir, array $files): void;
}
