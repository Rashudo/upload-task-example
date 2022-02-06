<?php


namespace App\Containers\AppSection\UploadContainer\Contracts;

use Closure;

/**
 * Interface ImageHandlerContract
 * @package App\Containers\AppSection\UploadContainer\Contracts
 */
interface ImageHandlerContract
{
    /**
     * @param int $height
     * @return ImageHandlerContract
     */
    public function resizeToHeight(int $height): ImageHandlerContract;

    /**
     * @param int $width
     * @param int $height
     * @return ImageHandlerContract
     */
    public function cropTopLeft(int $width, int $height): ImageHandlerContract;

    /**
     * @param Closure $function
     * @return ImageHandlerContract
     */
    public function addFilter(Closure $function): ImageHandlerContract;

    /**
     * @param string $path
     * @return ImageHandlerContract
     */
    public function save(string $path): ImageHandlerContract;
}
