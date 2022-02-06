<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Actions;

use App\Containers\AppSection\UploadContainer\Adapters\ImageHandlerAdapter;
use App\Containers\AppSection\UploadContainer\Data\DTO\ImageSettingsTransfer;
use App\Containers\AppSection\UploadContainer\Data\DTO\SavedImageDataTransfer;
use App\Containers\AppSection\UploadContainer\Data\DTO\UploadDataTransfer;
use App\Containers\AppSection\UploadContainer\Data\Validators\Images\ImageInitValidator;
use App\Containers\AppSection\UploadContainer\Data\Validators\Images\ImageSizeValidator;
use App\Containers\AppSection\UploadContainer\Exceptions\FetchFileException;
use App\Containers\AppSection\UploadContainer\Exceptions\SaveFileException;
use App\Containers\AppSection\UploadContainer\Exceptions\ValidationException;
use App\Containers\AppSection\UploadContainer\Tasks\Images\AddTextToImagesTask;
use App\Containers\AppSection\UploadContainer\Tasks\Images\CropImageTask;
use App\Containers\AppSection\UploadContainer\Tasks\Images\FetchImageTask;
use App\Containers\AppSection\UploadContainer\Tasks\Images\ResizeImageTask;
use App\Containers\AppSection\UploadContainer\Tasks\Images\SaveImageTask;
use App\Containers\AppSection\UploadContainer\Tasks\SaveFileDataTask;
use App\Containers\AppSection\UploadContainer\Traits\FileTools;
use Gumlet\ImageResizeException;
use Illuminate\Http\UploadedFile;
use Throwable;


/**
 * Class UploadNewImageAction
 * @package App\Containers\AppSection\UploadContainer\Actions
 */
final class UploadNewImageAction
{
    use FileTools;

    /**
     * @var UploadedFile
     */
    private UploadedFile $uploadedFile;
    /**
     * @var ImageSettingsTransfer
     */
    private ImageSettingsTransfer $imageSettings;


    /**
     * Upload image from url use case
     *
     * @param UploadDataTransfer $uploadDataTransfer
     * @return SavedImageDataTransfer
     * @throws ValidationException
     * @throws FetchFileException
     * @throws ImageResizeException
     * @throws SaveFileException
     * @throws Throwable
     */
    public function run(
        UploadDataTransfer $uploadDataTransfer
    ): SavedImageDataTransfer {
        //answer DTO
        $savedImageDataTransfer = new SavedImageDataTransfer();

        //upload file
        $this->uploadedFile = FetchImageTask::fetchByUrl($uploadDataTransfer->url);

        $this->imageSettings = ImageSettingsTransfer::createFromArray(
            [
                'maxWidth' => env('MAX_IMAGE_WIDTH'),
                'maxHeight' => env('MAX_IMAGE_HEIGHT'),
                'cropWidth' => env('CROP_IMAGE_WIDTH'),
                'cropHeight' => env('CROP_IMAGE_HEIGHT'),
                'fileName' => self::getFileName($this->uploadedFile),
                'filePath' => storage_path(
                    env('IMAGE_STORAGE')
                )
            ]
        );

        //validate Image
        $this->validateImage();

        $imageHandlerAdapter = new ImageHandlerAdapter(
            $this->uploadedFile
        );

        ResizeImageTask::run(
            $imageHandlerAdapter,
            $this->imageSettings
        );

        CropImageTask::run(
            $imageHandlerAdapter,
            $this->imageSettings
        );

        AddTextToImagesTask::run(
            $imageHandlerAdapter,
            env('IMAGE_TEXT')
        );

        SaveImageTask::run(
            $imageHandlerAdapter,
            $this->imageSettings,
        );

        //check whether file really exists
        $this->fileExists();

        SaveFileDataTask::run(
            $this->imageSettings
        );

        $savedImageDataTransfer
            ->setSuccess(true)
            ->setUrl(
                self::joinPath(
                    env('APP_URL'),
                    env('PUBLIC_STORAGE'),
                    $this->imageSettings->fileName
                )
            );

        return $savedImageDataTransfer;
    }

    /**
     * @throws ValidationException
     */
    private function validateImage()
    {
        $initValidator = new ImageInitValidator(
            $this->uploadedFile
        );
        $initValidator->add(
            new ImageSizeValidator(
                $this->uploadedFile,
                $this->imageSettings
            )
        );

        $imageValidated = $initValidator->validate();

        if ($imageValidated->fail) {
            throw new ValidationException($imageValidated->message);
        }
    }

    /**
     * @throws SaveFileException
     */
    private function fileExists()
    {
        $exists = file_exists(
            self::joinPath(
                $this->imageSettings->filePath,
                $this->imageSettings->fileName
            )
        );

        if (!$exists) {
            throw new SaveFileException();
        }
    }
}
