<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Tasks;


use App\Containers\AppSection\UploadContainer\Data\DTO\ImageSettingsTransfer;
use App\Containers\AppSection\UploadContainer\Models\Image;
use Throwable;

/**
 * Class SaveFileDataTask
 * @package App\Containers\AppSection\UploadContainer\Tasks
 */
final class SaveFileDataTask
{

    /**
     * @param ImageSettingsTransfer $imageSettings
     * @return bool
     * @throws Throwable
     */
    public static function run(ImageSettingsTransfer $imageSettings): bool
    {
        return (new Image())
            ->fill(
                [
                    'name' => $imageSettings->fileName
                ]
            )
            ->saveOrFail();
    }
}
