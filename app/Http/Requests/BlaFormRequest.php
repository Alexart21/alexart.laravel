<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ReCaptchaV3;

class BlaFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reCaptcha' => ['required', new ReCaptchaV3],
            'name' => 'required|min:3|max:10',
            'age' => 'required|integer|max:100',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
