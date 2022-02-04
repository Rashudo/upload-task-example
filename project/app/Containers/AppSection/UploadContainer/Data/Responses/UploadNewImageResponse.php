<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\Responses;

/**
 * Class UploadNewImageResponse
 * @package App\Containers\AppSection\UploadContainer\Data\Responses
 */
class UploadNewImageResponse
{
    /**
     * @var bool
     */
    public bool $success = false;

    /**
     * @var string|null
     */
    public ?string $url = null;
    /**
     * @var string
     */
    public string $error = 'Upload Failed';
}
