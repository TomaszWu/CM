<?php

declare(strict_types=1);

namespace App\Service\File\Cloud;

class CloudClient
{
    private CloudClientProvider $clientProvider;

    public function __construct(CloudClientProvider $clientProvider)
    {
        $this->clientProvider = $clientProvider;
    }

    public function saveFile(string $target, string $key, string $srcPath): void
    {
        $this->clientProvider->getClient()->putObject([
            'Bucket' => $target,
            'Key'    => $key,
            'SourceFile' => $srcPath
        ]);
    }
}
