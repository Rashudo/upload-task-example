<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Tasks\Images;

use App\Containers\AppSection\UploadContainer\Contracts\ImageHandlerContract;
use App\Containers\AppSection\UploadContainer\Data\DTO\ImageSettingsTransfer;

/**
 * Class SaveImageTask
 * @package App\Containers\AppSection\UploadContainer\Tasks\Images
 */
final class SaveImageTask
{

    /**
     * @param ImageHandlerContract $imageHandlerAdapter
     * @param ImageSettingsTransfer $imageSettings
     * @return ImageHandlerContract
     */
    public static function run(
        ImageHandlerContract $imageHandlerAdapter,
        ImageSettingsTransfer $imageSettings,
    ): ImageHandlerContract {
        return $imageHandlerAdapter->save(
            $imageSettings->filePath . $imageSettings->fileName
        );
    }
}
