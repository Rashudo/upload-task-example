<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Models;


use App\Ship\Models\ShipModel;

/**
 * Class File
 * @package App\Containers\AppSection\UploadContainer\Models
 *
 * @property int $id
 * @property string $name
 */
final class Image extends ShipModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
}
