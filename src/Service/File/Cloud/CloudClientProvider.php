<?php

declare(strict_types=1);

namespace App\Service\File\Cloud;

use Aws\S3\S3Client;
use Aws\S3\S3ClientInterface;

class CloudClientProvider
{
    private ?S3ClientInterface $s3Client;

    public function __construct()
    {
        $this->s3Client = null;
    }

    public function getClient(): S3ClientInterface
    {
        if (!$this->s3Client) {
            $this->s3Client = new S3Client([
                'region'  => $_ENV['AWS_REGION'],
                'version' => 'latest',
                'credentials' => [
                    'key'    => $_ENV['AWS_KEY_PUB'],
                    'secret' => $_ENV['AWS_KEY_SECRET'],
                ]
            ]);
        }

        return $this->s3Client;
    }
}
