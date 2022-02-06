<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\DTO;

/**
 * Class ValidationResult
 * @package App\Containers\AppSection\UploadContainer\Data\DTO
 */
final class ValidationResult
{
    /**
     * @var bool $fail
     */
    public bool $fail = false;

    /**
     * @var string
     */
    public string $message = 'An Error';
}
