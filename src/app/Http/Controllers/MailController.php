<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        // フォームから送信されたデータを取得
        $destination = $request->input('destination');
        $message = $request->input('message');

        // 送信先のメールアドレスを設定
        switch ($destination) {
            case 'all':
                $email = 'all@example.com'; // すべてのユーザーに送信する場合のメールアドレス
                break;
            case 'user':
                $email = 'user@example.com'; // ユーザーに送信する場合のメールアドレス
                break;
            case 'writer':
                $email = 'writer@example.com'; // 店舗代表者に送信する場合のメールアドレス
                break;
            case 'admin':
                $email = 'admin@example.com'; // 管理者に送信する場合のメールアドレス
                break;
            default:
                $email = null;
        }

        // メールを送信
        if ($email) {
            Mail::to($email)->send(new NotificationMail($message)); // NotificationMail はメールの内容を定義したメールクラス
            return redirect()->back()->with('success', 'メールを送信しました');
        } else {
            return redirect()->back()->with('error', '無効な送信先が選択されました');
        }
    }

}
