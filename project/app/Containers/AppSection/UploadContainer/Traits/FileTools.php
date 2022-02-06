<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Traits;

/**
 * Trait ImageTools
 * @package App\Containers\AppSection\UploadContainer\Traits
 */
trait FileTools
{

    /**
     * @param $uploadedFile
     * @return string
     */
    private static function getFileName($uploadedFile): string
    {
        return $uploadedFile->getFilename() . '.' . $uploadedFile->extension();
    }

    /**
     * @param mixed ...$params
     * @return string
     */
    private static function joinPath(...$params): string
    {
        return join('', $params);
    }

}
