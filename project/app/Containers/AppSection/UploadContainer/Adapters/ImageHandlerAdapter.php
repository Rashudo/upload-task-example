<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Adapters;

use App\Containers\AppSection\UploadContainer\Contracts\ImageHandlerContract;
use Closure;
use Gumlet\ImageResize;
use Gumlet\ImageResizeException;
use Illuminate\Http\UploadedFile;

/**
 * Class ImageHandlerAdapter
 * @package App\Containers\AppSection\UploadContainer\Adapters
 */
class ImageHandlerAdapter implements ImageHandlerContract
{
    private ImageResize $client;

    /**
     * ImageHandlerAdapter constructor.
     * @param UploadedFile $uploadedFile
     * @throws ImageResizeException
     */
    public function __construct(UploadedFile $uploadedFile,)
    {
        $this->client = new ImageResize($uploadedFile->getPathname());
    }

    public function resizeToHeight(int $height): ImageHandlerContract
    {
        $this->client->resizeToHeight($height);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function cropTopLeft(int $width, int $height): ImageHandlerContract
    {
        $this->client->crop(
            $width,
            $height,
            true,
            ImageResize::CROPLEFT
        );
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addFilter(Closure $function): ImageHandlerContract
    {
        $this->client->addFilter($function);
        return $this;
    }

    /**
     * @inheritDoc
     * @throws ImageResizeException
     */
    public function save(string $path): ImageHandlerContract
    {
        $this->client->save($path);
        return $this;
    }
}
