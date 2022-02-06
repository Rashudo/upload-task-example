<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\Tasks\Images;

use App\Containers\AppSection\UploadContainer\Exceptions\FetchFileException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class FetchImageTask
 * @package App\Containers\AppSection\UploadContainer\Tasks\Images
 */
final class FetchImageTask
{
    private UploadedFile $fetchedImageTransfer;

    /**
     * @param string $url
     * @return UploadedFile
     * @throws FetchFileException
     */
    public static function fetchByUrl(string $url): UploadedFile
    {
        $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR;
        $originalName = uniqid();

        $response = Http::send(
            'GET',
            $url,
            [
                'sink' => $filePath . $originalName
            ]
        );

        if (!$response->ok()) {
            throw new FetchFileException();
        }

        return new UploadedFile(
            $filePath . $originalName,
            $originalName
        );
    }

    /**
     * @return UploadedFile
     */
    private function run(): UploadedFile
    {
        return $this->fetchedImageTransfer;
    }
}
