<?php

namespace App\Http\Requests\Pa;

use Illuminate\Foundation\Http\FormRequest;

class MainUserRequest extends FormRequest
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
            'birthday' => ['required', 'date', 'before:today'],
            'study_place' => ['required'],
            'specialty' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'birthday.required' => 'Поле дата рождения обязательное',
            'birthday.date' => 'Некорректный формат даты рождения',
            'birthday.before:today' => 'Некорректная дата рождения',
            'study_place.required' => 'Поле место учебы обязательное',
            'specialty' => 'Поле специальность обязвтельное',
        ];
    }
}
