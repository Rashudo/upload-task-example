<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Data\DTO;

use Illuminate\Http\Request;

/**
 * Class UploadDataTransfer
 * @package App\Containers\AppSection\UploadContainer\Data\DTO
 */
final class UploadDataTransfer
{

    public string $url;

    /**
     * @param Request $request
     * @return UploadDataTransfer
     */
    public static function createFromRequest(Request $request): UploadDataTransfer
    {
        $instance = new self();

        $instance->url = (string) $request->json('url', '');

        return $instance;
    }
}
