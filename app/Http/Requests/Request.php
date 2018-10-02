<?php namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use Dingo\Api\Exception\ResourceException;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{

    public function failedValidation(Validator $validator)
    {
        $validation = $validator->messages()->all();
        $showError = (isset($validation[0])) ? $validation[0] : "error";
        throw new ResourceException($showError, $validation);
    }

}
