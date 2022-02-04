<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Tasks\Images;

use App\Containers\AppSection\UploadContainer\Contracts\ImageHandlerContract;
use Closure;

/**
 * Class AddTextToImagesTask
 * @package App\Containers\AppSection\UploadContainer\Tasks\Images
 */
final class AddTextToImagesTask
{

    /**
     * @param ImageHandlerContract $imageHandlerAdapter
     * @param string $message
     * @return ImageHandlerContract
     */
    public static function run(
        ImageHandlerContract $imageHandlerAdapter,
        string $message
    ): ImageHandlerContract {
        $imageHandlerAdapter->addFilter(
            self::handleConnection($message)
        );
        return $imageHandlerAdapter;
    }

    /**
     * @param string $message
     * @return Closure
     */
    private static function handleConnection(string $message): Closure
    {
        return function ($imageDesc) use ($message) {
            $color = imagecolorallocate($imageDesc, 0, 0, 0);
            imagestring($imageDesc, 20, 0, 0, $message, $color);
        };
    }
}
