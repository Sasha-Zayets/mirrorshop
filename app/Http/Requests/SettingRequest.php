<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'phones.*.number' => 'required',
            'location.*' => 'required|string|max:255',
            'socials' => 'required|array',
            'schedule' => 'required|array',
            'schedule.monday.*' => 'required|string|max:10',
            'schedule.weekdays.*' => 'required|string|max:10',
            'schedule.saturday.*' => 'required|string|max:10',
            'schedule.sunday.*' => 'required|string|max:10',
            'schedule.monday.holiday' => 'required|boolean',
            'schedule.weekdays.holiday' => 'required|boolean',
            'schedule.saturday.holiday' => 'required|boolean',
            'schedule.sunday.holiday' => 'required|boolean',
        ];
    }
}
