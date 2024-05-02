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
    public function store(ReseFormRequest $request, Shop $shop)
    {
        // 既存の予約があるかどうかを確認
    $reservation = Reservation::where('shop_id', $shop->id)
                                ->where('user_id', Auth::id())
                                ->first();

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
