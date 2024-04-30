<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Carbon;

class ReseFormRequest extends FormRequest
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
        'date' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:' . Carbon::today()->addMonths(1)->endOfMonth()->toDateString()],
        'time' => ['required', 'integer', 'between:0,4'],
        'number' => ['required', 'integer', 'between:1,5'],
    ];
}

public function messages()
{
    return [
        'date.required' => '日付を選択してください。',
        'date.date' => '有効な日付を入力してください。',
        'date.after_or_equal' => '今日以降の日付を選択してください。',
        'date.before_or_equal' => '1か月先までの日付を選択してください。それ以降はお電話予約にてお願いします。',
        'time.required' => '時間を選択してください。',
        'time.integer' => '時間の形式が正しくありません。',
        'time.between' => '時間は17時から21時の間で選択してください。',
        'number.required' => '人数を選択してください。',
        'number.integer' => '人数の形式が正しくありません。',
        'number.between' => '人数は1人から5人の間で選択してください。',
    ];
}
}
