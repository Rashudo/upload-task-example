<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\DTO;

use JetBrains\PhpStorm\Pure;

/**
 * Class ImageSettingsTransfer
 * @package App\Containers\AppSection\UploadContainer\Data\DTO
 */
final class ImageSettingsTransfer
{
    /**
     * @var int
     */
    public int $maxWidth;

    /**
     * @var int
     */
    public int $maxHeight;

    /**
     * @var int
     */
    public int $cropWidth;

    /**
     * @var int
     */
    public int $cropHeight;

    /**
     * @var string
     */
    public string $fileName;

    /**
     * @var string
     */
    public string $filePath;

    /**
     * @param array $data
     * @return ImageSettingsTransfer
     */
    #[Pure] public static function createFromArray(array $data): ImageSettingsTransfer
    {
        $instance = new self();

        $instance->maxWidth = (int)$data['maxWidth'];
        $instance->maxHeight = (int)$data['maxHeight'];

        $instance->cropWidth = (int)$data['maxWidth'];
        $instance->cropHeight = (int)$data['maxHeight'];

        $instance->fileName = (string)$data['fileName'];
        $instance->filePath = (string)$data['filePath'];

        return $instance;
    }

}
