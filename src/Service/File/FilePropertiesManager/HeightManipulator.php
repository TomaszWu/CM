<?php

declare(strict_types=1);

namespace App\Service\File\FilePropertiesManager;

use App\Service\File\OutputHandler\OutputHandlerFactory;
use App\Service\Image\ImageFormatter\ImageHeightCalculator;

class HeightManipulator
{
    public const TEMP_DIR = '/../../../../temp/';

    private OutputHandlerFactory $factory;

    public function __construct(OutputHandlerFactory $factory)
    {
        $this->factory = $factory;
    }

    public function setHeightToImages(string $srcDir, array $files, int $desireHeight, ImageHeightCalculator $calculator): void
    {
        foreach ($files as $file) {
            $pathToFile = __DIR__ . $srcDir . $file;

            $size = getimagesize($pathToFile);

            $width = $calculator->calculateWidth($size[1], $size[0], $desireHeight);

            $src = imagecreatefromstring(file_get_contents($pathToFile));
            $dst = imagecreatetruecolor($width, $desireHeight);

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $desireHeight, $size[0], $size[1]);

            $outputHandler = $this->factory->getOutputHandler($size['mime']);

            $outputHandler->handleFile($dst, __DIR__ . self::TEMP_DIR . $file);

            imagedestroy($src);
            imagedestroy($dst);
        }
    }

    public function clearFilesInTemp(array $files): void
    {
        foreach ($files as $file) {
            unlink(__DIR__ . self::TEMP_DIR . $file);
        }
    }
}
