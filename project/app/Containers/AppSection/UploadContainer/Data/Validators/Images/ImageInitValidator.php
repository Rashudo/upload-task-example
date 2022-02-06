<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\Validators\Images;


use App\Containers\AppSection\UploadContainer\Contracts\ValidatorContract;
use App\Containers\AppSection\UploadContainer\Data\DTO\ValidationResult;
use App\Containers\AppSection\UploadContainer\Data\Validators\BaseValidator;
use Illuminate\Http\UploadedFile;
use JetBrains\PhpStorm\Pure;

/**
 * Class ImageInitValidator
 * @package App\Containers\AppSection\UploadContainer\Data\Validators\Images
 */
class ImageInitValidator extends BaseValidator implements ValidatorContract
{
    /**
     * ImageInitValidator constructor.
     * @param UploadedFile $uploadedFile
     */
    #[Pure] public function __construct(
        private UploadedFile $uploadedFile,
    ) {
        parent::__construct();
    }

    public function validate(): ValidationResult
    {
        $success = str_contains(
            $this->uploadedFile->getMimeType(),
            'image'
        );
        $this->validationResult->fail = !$success;
        if ($this->validationResult->fail) {
            $this->validationResult->message = 'Unsupported Type';
        }
        return parent::validate();
    }
}
