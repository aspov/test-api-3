<?php

// app/Http/Requests/ApiFormRequest.php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiFormRequest extends ApiFormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        $jsonResponse = response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        throw new HttpResponseException($jsonResponse);
    }
}
