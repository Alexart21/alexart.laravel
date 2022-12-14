<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class TestFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:128',
            'email' => 'email',
            'phone' => 'min:6|max:20',
            'body' => 'required|min:2|max:10000',
        ];
    }

    protected function failedValidation(Validator $validator) {
        $response = response()
            ->json([ 'result' => false, 'errors' => $validator->errors()], 422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'email' => 'Еmail',
            'phone' => 'Тел.',
            'body' => 'Текст',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Слишком коротко! не меьше 2',
            'body.min' => 'Слишком коротко! не меьше 2',
        ];
    }
}
