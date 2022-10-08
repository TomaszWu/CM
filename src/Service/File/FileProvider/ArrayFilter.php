<?php

declare(strict_types=1);

namespace App\Service\File\FileProvider;

class ArrayFilter
{
    public function removeUnwantedValuesFromArray(array $files, array $valuesToRemove): array
    {
        $result = [];

        foreach ($files as $file) {
            if (in_array($file, $valuesToRemove)) {
                continue;
            }

            $result[] = $file;
        }

        return $result;
    }
}
