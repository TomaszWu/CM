<?php

namespace App\Command;

use App\Service\File\FileHandler\CloudFileHandler;
use App\Service\File\FileHandler\DirFileHandler;
use App\Service\File\FilePropertiesManager\HeightManipulator;
use App\Service\File\FileProvider\ArrayFilter;
use App\Service\File\FileProvider\DirFileProvider;
use App\Service\Image\ImageFormatter\ImageHeightCalculator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:upload-images',
)]
class UploadImagesCommand extends Command
{
    private DirFileProvider $dirFileProvider;

    private ArrayFilter $arrayFilter;

    private HeightManipulator $heightManipulator;

    private DirFileHandler $dirFileHandler;

    private CloudFileHandler $cloudFileHandler;

    public function __construct(
        DirFileProvider $dirFileProvider,
        ArrayFilter $arrayFilter,
        HeightManipulator $heightManipulator,
        DirFileHandler $dirFileHandler,
        CloudFileHandler $cloudFileHandler
    ) {
        $this->dirFileProvider = $dirFileProvider;
        $this->arrayFilter = $arrayFilter;
        $this->heightManipulator = $heightManipulator;
        $this->dirFileHandler = $dirFileHandler;
        $this->cloudFileHandler = $cloudFileHandler;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $srcDir = __DIR__ . '/../../file/';

        $files = $this->dirFileProvider->getFiles($srcDir);

        $files = $this->arrayFilter->removeUnwantedValuesFromArray($files, ['.', '..']);

        $this->heightManipulator->setHeightToImages(
            '/../../../../file/',
            $files,
            150,
            new ImageHeightCalculator(),
        );

        $fileHandlerResultDir = '/../../../../file2/';

        $this->dirFileHandler->handleFiles(HeightManipulator::TEMP_DIR, $fileHandlerResultDir, $files);
        $this->cloudFileHandler->handleFiles(HeightManipulator::TEMP_DIR , 'file2', $files);

        $this->heightManipulator->clearFilesInTemp($files);

        $io->success('All images copied');

        return Command::SUCCESS;
    }
}
