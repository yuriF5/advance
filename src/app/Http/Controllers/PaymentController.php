<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Http\Requests\StorePaymentRequest;
use Exception;

class PaymentController extends Controller
{

    /**
     * 決済フォーム表示
     */
    public function create()
    {
        return view('payment.create');
    }

    /**
     * 決済実行
     */
    public function store(StorePaymentRequest $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_secret_key'));

        try {
            \Stripe\Charge::create([
                'source' => $request->stripeToken,
                'amount' => 5000,
                'currency' => 'jpy',
            ]);
        } catch (Exception $e) {
            return back()->with('flash_alert', '決済に失敗しました！('. $e->getMessage() . ')');
        }
        return back()->with('status', '決済が完了しました！');
    }
}