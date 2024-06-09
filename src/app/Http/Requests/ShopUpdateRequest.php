<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:15',
            'area' => 'required',
            'genre' => 'required',
            'description' => 'required|string|max:300',
            'image_file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須です。',
            'name.string' => '店舗名は文字列で入力してください。',
            'name.max' => '店舗名は15文字以内で入力してください。',
            'area.required' => '地域は選択は必須です。',
            'genre.required' => 'ジャンルは選択必須です。',
            'description.required' => 'お店の紹介は必須です。',
            'description.string' => '文字列で入力してください。',
            'description.max' => '300文字以内で入力してください。',
            'image_file.required' => '写真を選択してください。',
        ];
    }
}