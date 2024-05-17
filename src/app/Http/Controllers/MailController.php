<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;
use App\Models\User;
use App\Jobs\SendNotificationEmail;

class MailController extends Controller
{
    public function sendNotification(Request $request)
    {
    $destination = $request->input('destination');
    $messageContent = $request->input('message');

    if ($destination === 'all') {
        SendNotificationEmail::dispatch(User::all(), $messageContent);
    } elseif ($destination === 'user') {
        SendNotificationEmail::dispatch(User::doesntHave('role')->get(), $messageContent);
    } else {
        $role = Role::findByName($destination);
        $users = $role ? $role->users : collect();

        SendNotificationEmail::dispatch($users, $messageContent);
    }

    return back()->with('success', '送信完了しました。');
    }
    

    public function email()
    {
        return view('admin.email_send');
    }
}

