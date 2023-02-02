<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class DesignerFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'screen' => 'required|file|image|mimes:png|max:500',
        ];
    }

    public function messages()
    {
        return [
            'screen.mime' => 'Только файлы PNG!',
            'screen.max' => 'Не более 500 кБ!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()
            ->json(['result' => false, 'errors' => $validator->errors()], 422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
