<?php

namespace App\Http\Requests\Pa;

use Illuminate\Foundation\Http\FormRequest;

class DissertationWorkRequest extends FormRequest
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
            'year' => ['required', 'date_format:Y'],
            'topic' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'year.required' => 'Поле год обязательное',
            'year.date_format' => 'Поле год имеет некорректный формат',
            'topic.required' => 'Поле тема обязательное',
        ];
    }
}
