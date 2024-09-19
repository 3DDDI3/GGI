<?php

namespace App\Http\Requests\Authorization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class SignRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->password != $this->retypePassword)
                $validator->errors()->add('passwordCheck', 'Пароли не совпадают');
        });
    }

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
            'birthday' => ['required', 'date', 'before:today'],
            'email' => ['required', 'email', 'unique:acounts'],
            'password' =>  ['required'],
            'retypePassword' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'lastName.required' => 'Поле фамилия обязательное',
            'firstName.required' => 'Поле имя обязательное',
            'secondName.required' => 'Поле отчество обязательное',
            'birthday.required' => 'Поле дата рождения обязательное',
            'birthday.date' => 'Некорректный формат даты рождения',
            'birthday.before:today' => 'Некорректная дата рождения',
            'email.required' => 'Поле email обязательное',
            'email.email' => 'Email некорректный',
            'email.unique' => 'Такой email уже существует',
            'password.required' => 'Поле пароль обязательное',
            'retypePassword.required' => 'Поле повторите пароль обязательное',
        ];
    }
}
