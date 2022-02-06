<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\DTO;

/**
 * Class ImageDataTransfer
 * @package App\Containers\AppSection\UploadContainer\Data\DTO
 */
final class ImageDataTransfer
{

    /**
     * ImageDataTransfer constructor.
     * @param string $name
     * @param string $path
     */
    public function __construct(
        public string $name,
        public string $path
    ) {
    }
}
