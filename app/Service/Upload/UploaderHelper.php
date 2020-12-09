<?php

declare(strict_types=1);

namespace App\Service\Upload;

use Gedmo\Sluggable\Util\Urlizer;
use Illuminate\Support\Facades\Storage;
use Psr\Log\LoggerInterface;
use Illuminate\Http\UploadedFile;

final class UploaderHelper
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @throws \Exception
     */
    public function uploadFile(UploadedFile $file, string $directory, string $option)
    {
        $originalFileName = $file->getClientOriginalName();
        return $this->upload($file, $originalFileName, $file->guessExtension(), $directory, $option);
    }

    /**
     * @throws \League\Flysystem\FileExistsException
     * @throws \Exception
     */
    private function upload(UploadedFile $file, string $fileName, string $fileExtension, string $directory, $option)
    {
        $newFileName = Urlizer::urlize(pathinfo($fileName, PATHINFO_FILENAME)). '-' .uniqid() . '.' . $fileExtension;

        $result = $file->storeAs($directory, $newFileName, $option);

        if ($result === false) {
            throw new \Exception(sprintf('Could not write uploaded file "%s"', $newFileName));
        }

        return $newFileName;
    }

    public function deleteOldFile(string $path)
    {
        $result = Storage::disk('public')->delete($path);

        if (!$result) {
            throw new \Exception(sprintf('Could not delete old uploaded file "%s"', $path));
        }
    }
}
