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
        return Auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // регуляреа - только кириллица пробел и дефис
            /*'name' => 'required|min:2|max:128|regex:/^[А-Яа-яё -]*$/ui',
            'email' => 'email',
            'phone' => 'min:6|max:20',
            'body' => 'required|min:2|max:10000',*/
//            'photo' => 'file|image|mimes:jpg,jpeg,png|max:200',
                'title' => 'max:255',
            'avatar' => 'file|image|mimes:jpg,jpeg,png|max:200',
        ];
    }

    /*protected function failedValidation(Validator $validator) {
        $response = response()
            ->json([ 'result' => false, 'errors' => $validator->errors()], 422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag);
    }*/

    public function attributes()
    {
        return [
            /*'name' => 'Имя',
            'email' => 'Еmail',
            'phone' => 'Тел.',
            'body' => 'Текст',*/
        ];
    }

    public function messages()
    {
        return [
            /*'name.min' => 'Слишком коротко! не меьше 2',
            'name.regex' => 'Только кириллица без цифр и спецсимволов!',
            'body.min' => 'Слишком коротко! не меьше 2',*/
        ];
    }
}
