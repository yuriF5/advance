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
    // 今日の日付
$today = date('Y-m-d');

// 1ヶ月後の最終日を計算
$oneMonthLater = date('Y-m-d', strtotime('+1 month'));
    return [
        'date' => [
        'required',
        'date',
        'after_or_equal:' . $today,
        'before_or_equal:' . $oneMonthLater,
    ],
        'time' => ['required', 'string', \Illuminate\Validation\Rule::in(['17:00', '18:00', '19:00', '20:30', '21:00'])],
        'number' => 'required|integer|min:1',
    ];
}

public function messages()
{
    return [
        'date.required' => '日付を選択してください。',
        'date.date' => '有効な日付を入力してください。',
        'date.after_or_equal' => '今日以降の日付を選択してください。',
        'date.before_or_equal' => '1か月までの日付を選択してください。',
        'time.required' => '時間を選択してください。',
        'number.required' => '人数を指定してください。',
        'number.min' => '少なくとも1人以上の人数を指定してください。',
    ];
}
}
