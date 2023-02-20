<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AjaxSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // можно было просто вернуть true здесь это непринципиально
        return auth()->user()->can('admin');
//        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
            'data' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'id' => 'Нет параметра id',
            'data.min' => '3 символа хотя бы ...',
        ];
    }

    protected function failedValidation(Validator $validator) {
        $response = response()
            ->json([ 'success' => false, 'errors' => $validator->errors()], 422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
