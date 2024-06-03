<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return mixed
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }
}