<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'card_number' => 'required|numeric|digits_between:13,19',
            'card_expiry' => 'required|date_format:m/y|after:today',
            'card_cvc' => 'required|numeric|digits:3',
        ];
    }

    /**
     * バリデーションエラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'card_number.required' => 'カード番号は必須です。',
            'card_number.numeric' => 'カード番号は数字である必要があります。',
            'card_number.digits_between' => 'カード番号は13桁から19桁の間である必要があります。',
            'card_expiry.required' => '有効期限は必須です。',
            'card_expiry.date_format' => '有効期限の形式はMM/YYである必要があります。',
            'card_expiry.after' => '有効期限は現在の日付以降である必要があります。',
            'card_cvc.required' => 'セキュリティコードは必須です。',
            'card_cvc.numeric' => 'セキュリティコードは数字である必要があります。',
            'card_cvc.digits' => 'セキュリティコードは3桁である必要があります。',
        ];
    }
}