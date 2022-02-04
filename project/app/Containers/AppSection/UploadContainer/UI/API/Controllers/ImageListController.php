<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\UI\API\Controllers;

use App\Containers\AppSection\UploadContainer\Actions\GetAllImagesAction;
use App\Ship\Http\Controllers\ApiController;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

/**
 * Class ImageListController
 * @package App\Containers\AppSection\UploadContainer\UI\API\Controllers
 */
final class ImageListController extends ApiController
{

    /**
     * @return Response|ResponseFactory
     */
    public function __invoke(): Response|ResponseFactory
    {
        $images = (new GetAllImagesAction())->run();

        return response($images);
    }
}
