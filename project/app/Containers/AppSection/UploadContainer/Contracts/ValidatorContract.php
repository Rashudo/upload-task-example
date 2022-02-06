<?php


namespace App\Containers\AppSection\UploadContainer\Contracts;

use App\Containers\AppSection\UploadContainer\Data\DTO\ValidationResult;

/**
 * Interface ValidatorContract
 * @package App\Containers\AppSection\UploadContainer\Contracts
 */
interface ValidatorContract
{
    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult;
}
