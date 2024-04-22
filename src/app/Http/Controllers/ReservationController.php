<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $reservation = new Reservation();
        $reservation->shop_id = $shop->id;
        $reservation->user_id = Auth::user()->id;
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->status = "予約";
        $reservation->save();

        return redirect('/done');
    }
}
