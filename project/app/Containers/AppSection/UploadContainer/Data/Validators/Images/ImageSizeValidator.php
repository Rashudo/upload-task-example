<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\Validators\Images;


use App\Containers\AppSection\UploadContainer\Contracts\ValidatorContract;
use App\Containers\AppSection\UploadContainer\Data\DTO\ImageSettingsTransfer;
use App\Containers\AppSection\UploadContainer\Data\DTO\ValidationResult;
use App\Containers\AppSection\UploadContainer\Data\Validators\BaseValidator;
use Illuminate\Http\UploadedFile;
use JetBrains\PhpStorm\Pure;

/**
 * Class ImageSizeValidator
 * @package App\Containers\AppSection\UploadContainer\Data\Validators\Images
 */
class ImageSizeValidator extends BaseValidator implements ValidatorContract
{
    /**
     * ImageSizeValidator constructor.
     * @param UploadedFile $uploadedFile
     * @param ImageSettingsTransfer $imageSettings
     */
    #[Pure] public function __construct(
        private UploadedFile $uploadedFile,
        private ImageSettingsTransfer $imageSettings
    ) {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function validate(): ValidationResult
    {
        list($width, $height) = getimagesize($this->uploadedFile->getPathname());
        $success = $width >= $this->imageSettings->maxWidth && $height >= $this->imageSettings->maxHeight;

        $this->validationResult->fail = !$success;

        if ($this->validationResult->fail) {
            $this->validationResult->message = sprintf(
                'Image size must be greater than %d in width and %d in height.',
                $this->imageSettings->maxWidth,
                $this->imageSettings->maxHeight
            );
        }

        return parent::validate();
    }
}
