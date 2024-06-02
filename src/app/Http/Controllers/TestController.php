<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ①追記
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class TestController extends Controller
{
	public function hoge(Request $request)
    {
        // メール送信に使うインスタンスを生成
        $welcomeMail = new WelcomeEmail();

        // メール送信
        Mail::send($welcomeMail);

        // 送信成功か確認
        if (count(Mail::failures()) > 0) {
            $message = 'メール送信に失敗しました';

            // 元の画面に戻る
            return redirect()->back()->withErrors($message);
        } else {
            $message = 'メールを送信しました';

            // 成功メッセージをセッションに保存してリダイレクト
            return redirect()->route('test')->with('message', $message);
        }
    }
}