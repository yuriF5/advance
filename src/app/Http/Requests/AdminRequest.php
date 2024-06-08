<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'shop' => 'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'shop.required' => '店舗を選択してください。',
            'name.required' => '代表者を選択してください。',
        ];
    }
}