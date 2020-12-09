<?php

declare(strict_types=1);

namespace App\Models\Employee\Services;

use App\Service\Upload\UploaderHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class ContractUploadService
{
    public const CONTRACT_DIRECTORY = 'contracts';
    public const FILE_OPTION = 'public';

    private UploaderHelper $uploaderHelper;

    public function __construct(UploaderHelper $uploaderHelper)
    {
        $this->uploaderHelper = $uploaderHelper;
    }

    public function upload(UploadedFile $file, string $contractPath, string $existingFilename=null)
    {
        $contractPath = self::CONTRACT_DIRECTORY . '/' . $contractPath;
        $fileName = $this->uploaderHelper->uploadFile($file, $contractPath,self::FILE_OPTION);

        !$existingFilename ?: $this->uploaderHelper->deleteOldFile($contractPath .'/' . $existingFilename);

        return $fileName;
    }
}
