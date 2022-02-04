<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Tasks\Images;


use App\Containers\AppSection\UploadContainer\Contracts\ImageHandlerContract;
use App\Containers\AppSection\UploadContainer\Data\DTO\ImageSettingsTransfer;

/**
 * Class CropImageTask
 * @package App\Containers\AppSection\UploadContainer\Tasks\Images
 */
final class CropImageTask
{
    /**
     * @param ImageHandlerContract $imageHandlerAdapter
     * @param ImageSettingsTransfer $imageSettings
     * @return ImageHandlerContract
     */
    public static function run(
        ImageHandlerContract $imageHandlerAdapter,
        ImageSettingsTransfer $imageSettings
    ): ImageHandlerContract {
        return $imageHandlerAdapter->cropTopLeft(
            $imageSettings->cropWidth,
            $imageSettings->cropHeight
        );
    }
}
