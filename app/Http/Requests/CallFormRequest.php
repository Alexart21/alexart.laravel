<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Rules\ReCaptchaV3;

class CallFormRequest  extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reCaptcha' => ['required', new ReCaptchaV3],
            'name' => 'required|min:2|max:128',
            'tel' => 'required|min:6|max:20',
        ];
    }

    public function messages()
    {
        return [
            'reCaptcha.required' => 'Отсутствует параметр reCaptcha',
            'name.required' => 'Укажите имя',
            'name.min' => '2 буквы хотя бы...',
            'tel.required' => 'Укажите номер',
            'tel.min' => '6 цифр хотя бы...'
        ];
    }

    // возвращает JSON !
    protected function failedValidation(Validator $validator) {
        $response = response()
            ->json([ 'success' => false, 'errors' => $validator->errors()], 422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
