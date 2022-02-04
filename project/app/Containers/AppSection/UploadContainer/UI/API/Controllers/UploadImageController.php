<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\UI\API\Controllers;

use App\Containers\AppSection\UploadContainer\Actions\UploadNewImageAction;
use App\Containers\AppSection\UploadContainer\Data\DTO\UploadDataTransfer;
use App\Containers\AppSection\UploadContainer\Data\Responses\UploadNewImageResponse;
use App\Containers\AppSection\UploadContainer\Exceptions\FetchFileException;
use App\Containers\AppSection\UploadContainer\Exceptions\SaveFileException;
use App\Containers\AppSection\UploadContainer\Exceptions\ValidationException;
use App\Containers\AppSection\UploadContainer\UI\API\Requests\UploadValidation;
use App\Ship\Contracts\HttpConstants;
use App\Ship\Http\Controllers\ApiController;
use Gumlet\ImageResizeException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use Throwable;

/**
 * Class UploadImageController
 * @package App\Containers\AppSection\UploadContainer\UI\API\Controllers
 */
final class UploadImageController extends ApiController
{
    use ProvidesConvenienceMethods;


    /**
     * @param UploadValidation $request
     * @return JsonResponse
     */
    public function __invoke(UploadValidation $request): JsonResponse
    {
        $uploadNewImageResponse = new UploadNewImageResponse();
        try {
            $requestValidator = $request->handle();

            //validate request
            if (!$requestValidator->passes()) {
                throw new ValidationException(
                    $requestValidator->errors()->first()
                );
            }

            $uploadDataTransfer = UploadDataTransfer::createFromRequest($request);

            //use case
            $uploadNewImageResponse = (new UploadNewImageAction())->run($uploadDataTransfer);
        } catch (ValidationException $validationException) {
            $uploadNewImageResponse->error = $validationException->getMessage();
            Log::error($uploadNewImageResponse->error);
        } catch (FetchFileException $fetchFileException) {
            $uploadNewImageResponse->error = 'Failed to get the file';
            Log::error($uploadNewImageResponse->error);
        } catch (SaveFileException $saveFileException) {
            $uploadNewImageResponse->error = 'Failed to save the file';
            Log::error($uploadNewImageResponse->error);
        } catch (ImageResizeException $imageResizeException) {
            $uploadNewImageResponse->error = 'Failed to change image';
            Log::error($imageResizeException->getMessage());
        } catch (Throwable $exception) {
            $uploadNewImageResponse = new UploadNewImageResponse();
            Log::error($exception->getMessage());
        }

        return response()->json(
            $uploadNewImageResponse,
            HttpConstants::CREATED,
            [
                'Location' => $uploadNewImageResponse->url
            ]
        );
    }
}
