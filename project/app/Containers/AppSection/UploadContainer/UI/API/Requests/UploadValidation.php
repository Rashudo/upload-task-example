<?php

declare(strict_types=1);

namespace App\Containers\AppSection\UploadContainer\UI\API\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class UploadValidation
 * @package App\Containers\AppSection\UploadContainer\UI\API\Requests
 */
class UploadValidation extends Request
{
    private array $rules = [
        'url' => 'required|string'
    ];


    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function handle(): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $this->json()->all(),
            $this->rules,
        );
    }


}
