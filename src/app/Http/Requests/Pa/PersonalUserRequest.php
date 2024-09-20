<?php

namespace App\Http\Requests\Pa;

use Illuminate\Foundation\Http\FormRequest;

class PersonalUserRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'lastName' => ['required'],
            'firstName' => ['required'],
            'secondName' => ['required'],
            'email' => ['required', 'email'],
        ];
    }

    public function messages()
    {
        return [
            'lastName.required' => 'Поле фамилия обязательное',
            'firstName.required' => 'Поле имя обязательное',
            'secondName.required' => 'Поле отчество обязательное',
            'email.required' => 'Поле email обязательное',
            'email.email' => 'Email некорректный',
        ];
    }
}
