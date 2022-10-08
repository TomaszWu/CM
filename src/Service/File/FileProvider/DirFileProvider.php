<?php

declare(strict_types=1);

namespace App\Service\File\FileProvider;

class DirFileProvider implements FileProviderInterface
{
    public function getFiles(string $src): array
    {
        try {
            return scandir($src);
        } catch (\Exception $e) {
            return [];
        }
    }
}
