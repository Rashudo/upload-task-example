<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\Validators;


use App\Containers\AppSection\UploadContainer\Contracts\ValidatorContract;
use App\Containers\AppSection\UploadContainer\Data\DTO\ValidationResult;
use JetBrains\PhpStorm\Pure;

/**
 * Class BaseValidator
 * @package App\Containers\AppSection\UploadContainer\Data\Validators
 */
abstract class BaseValidator
{
    /**
     * @var ValidationResult
     */
    protected ValidationResult $validationResult;

    /**
     * @var ValidatorContract|null
     */
    protected ?ValidatorContract $nextHandler = null;

    /**
     * BaseValidator constructor.
     */
    #[Pure] public function __construct()
    {
        $this->validationResult = new ValidationResult();
    }

    /**
     * @param ValidatorContract $handler
     * @return ?ValidatorContract
     */
    public function add(ValidatorContract $handler): ?ValidatorContract
    {
        $this->nextHandler = $handler;

        return $this->nextHandler;
    }

    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult
    {
        if (
            !$this->validationResult->fail &&
            $this->nextHandler
        ) {
            return $this->nextHandler->validate();
        }
        return $this->validationResult;
    }
}
