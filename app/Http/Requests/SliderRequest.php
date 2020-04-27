<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        if($this->method() == 'POST') {
            return $this->createRules();
        }

        return $this->updateRules();
    }


    public function createRules()
    {
        return [
            'title_ua' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_ua' => 'required|string|max:255',
            'description_ru' => 'required|string|max:255',
            'active' => 'required|boolean',
            'new'   => 'array|required',
            'new.desktop' => 'required|string|max:255',
            'new.tablet' => 'required|string|max:255',
            'new.mobile' => 'required|string|max:255',
        ];
    }

    public function updateRules()
    {
        return [
            'id' => 'required|numeric',
            'title_ua' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_ua' => 'required|string|max:255',
            'description_ru' => 'required|string|max:255',
            'active' => 'required|boolean',
            'new'   => 'array'
        ];
    }
}
