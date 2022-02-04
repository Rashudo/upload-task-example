<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Actions;

use App\Containers\AppSection\UploadContainer\Data\DTO\ImageDataTransfer;
use App\Containers\AppSection\UploadContainer\Models\Image;
use App\Containers\AppSection\UploadContainer\Tasks\GetAllImagesTask;
use App\Containers\AppSection\UploadContainer\Traits\FileTools;
use Closure;
use Illuminate\Support\Collection;

/**
 * Class GetAllImagesAction
 * @package App\Containers\AppSection\UploadContainer\Actions
 */
final class GetAllImagesAction
{
    use FileTools;

    /**
     * @return Collection|Image[]
     */
    public function run(): Collection|array
    {
        $images = GetAllImagesTask::run();

        return $images->map(
            $this->prepareImageData()
        );
    }

    /**
     * @return Closure
     */
    private function prepareImageData(): Closure
    {
        return fn(Image $image) => new ImageDataTransfer(
            $image->name,
            self::joinPath(
                env('APP_URL'),
                env('PUBLIC_STORAGE'),
                $image->name
            )
        );
    }
}
