<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Containers\AppSection\UploadContainer\UI\API\Controllers\ImageListController;
use App\Containers\AppSection\UploadContainer\UI\API\Controllers\UploadImageController;
use Laravel\Lumen\Routing\Router;

$router->get(
    '/images',
    ImageListController::class
);

$router->post(
    '/images',
    UploadImageController::class
);
