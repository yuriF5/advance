<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use App\Models\User;
use App\Jobs\SendNotificationEmail;

class MailController extends Controller
{
    public function sendNotification(Request $request)
    {
        $destination = $request->input('destination');
        $messageContent = $request->input('message');
        $users = User::all();

        foreach ($users as $user) {
    Mail::to($user->email)->send(new NotificationMail($messageContent));
}
        return redirect()->back()->with('success', 'メールが送信されました！');
    }
    

    public function email()
    {
        return view('admin.email_send');
    }
}

