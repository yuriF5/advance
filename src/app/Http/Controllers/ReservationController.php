<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReseFormRequest;
use Illuminate\Support\Facades\Carbon;

class ReservationController extends Controller
{
// 予約処理
    public function store(ReseFormRequest $request, Shop $shop)
    {
        // 既存の予約があるかどうかを確認
        $reservation = Reservation::where('shop_id', $shop->id)->where('user_id', Auth::id())->first();
        // 予約データの作成または更新
        if ($reservation) {
            // 既存の予約がある場合は更新
            $reservation->update([
                'date' => $request->date,
                'time' => $request->time,
                'number_of_people' => $request->number,
            ]);
        } else {
            // 既存の予約がない場合は新規作成
            $reservation = new Reservation();
            $reservation->shop_id = $shop->id;
            $reservation->user_id = Auth::id(); 
            $reservation->date = $request->date;
            $reservation->time = $request->time;
            $reservation->number_of_people = $request->number;
            $reservation->save();
        }
        return redirect()->route('done');
    }

// 完了画面表示
    public function done()
    {
        return view('done');
    }

// 予約変更画面の表示
    public function edit(Reservation $reservation)
    {
        $user = Auth::user();
        $shop = Shop::find($reservation->shop_id);
        $availableTimes = ['17:00', '18:00', '19:00', '20:30', '21:00'];
        $numbers = range(1, 5);
        $backRoute = '/my_page';
        return view('edit.reservation', compact('reservation', 'user', 'shop', 'availableTimes','numbers','backRoute'));
    }

// 予約変更処理
    public function update(ReseFormRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number_of_people = $request->number;
        $reservation->save();
        return redirect()->route('done');
    }
}
