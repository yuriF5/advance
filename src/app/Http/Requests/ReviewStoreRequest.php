<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
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
            'star' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:400', 
        ];
    }

    public function messages()
    {
        return [
            'star.required' => '評価を選択してください。',
            'star.integer' => '評価は整数で指定してください。',
            'star.min' => '評価は1から5の範囲で指定してください。',
            'star.max' => '評価は1から5の範囲で指定してください。',
            'comment.max' => 'コメントは400文字以内で入力してください。',
        ];
    }
}
