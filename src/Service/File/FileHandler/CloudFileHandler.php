<?php

declare(strict_types=1);

namespace App\Service\File\FileHandler;

use App\Service\File\Cloud\CloudClient;

class CloudFileHandler implements FileHandleInterface
{
    private CloudClient $client;

    public function __construct(CloudClient $client)
    {
        $this->client = $client;
    }

    public function handleFiles(string $srcDir, string $targetDir, array $files): void
    {
        foreach ($files as $file) {
            $this->client->saveFile(
                $this->getTarget(),
                $targetDir . '/' . $file,
                __DIR__ . $srcDir . '/' . $file,
            );
        }
    }

    private function getTarget(): string
    {
        return $_ENV['AWS_BUCKET_NAME'];
    }
}
