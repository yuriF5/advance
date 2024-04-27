<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request, Shop $shop)
    {
        // バリデーション
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'number' => 'required|numeric|min:1|max:5',
        ]);

        // 予約データの作成
        $reservation = new Reservation();
        $reservation->shop_id = $shop->id;
        $reservation->user_id = Auth::id(); // 認証されたユーザーのIDを使用する
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number_of_people = $request->number;
        $reservation->save();

        // 完了ページにリダイレクト
        return redirect()->route('done');
    }

    public function done()
    {
        return view('done');
    }
    
    public function edit(Reservation $reservation)
    {
        $user = Auth::user();
        $shop = Shop::find($reservation->shop_id);


        $backRoute = '/mypage';

        return view('detail', compact('reservation', 'user', 'shop', 'backRoute'));
    }

}
