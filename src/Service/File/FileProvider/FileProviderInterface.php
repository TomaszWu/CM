<?php

namespace App\Service\File\FileProvider;

interface FileProviderInterface
{
    public function getFiles(string $src): array;
}
