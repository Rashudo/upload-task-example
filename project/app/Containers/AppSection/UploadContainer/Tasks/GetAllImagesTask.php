<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Tasks;

use App\Containers\AppSection\UploadContainer\Models\Image;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GetAllImagesTask
 * @package App\Containers\AppSection\UploadContainer\Tasks
 */
final class GetAllImagesTask
{

    /**
     * @return Collection|Image[]
     */
    public static function run(): Collection|array
    {
        return Image::all(
            [
                'name'
            ]
        );
    }
}
