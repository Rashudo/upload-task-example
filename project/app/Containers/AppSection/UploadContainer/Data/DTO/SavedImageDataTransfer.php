<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\DTO;

/**
 * Class SavedImageDataTransfer
 * @package App\Containers\AppSection\UploadContainer\Data\DTO
 */
final class SavedImageDataTransfer
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
     * @var string|null
     */
    public ?string $error = null;

    /**
     * @param bool $success
     * @return SavedImageDataTransfer
     */
    public function setSuccess(bool $success): SavedImageDataTransfer
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @param string|null $url
     * @return SavedImageDataTransfer
     */
    public function setUrl(?string $url): SavedImageDataTransfer
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string|null $error
     * @return SavedImageDataTransfer
     */
    public function setError(?string $error): SavedImageDataTransfer
    {
        $this->error = $error;
        return $this;
    }
}
