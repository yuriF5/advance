@extends('layouts.app')


@section('content')
<div class="container" style="text-align: center;">
    <h1>予約情報QRコード</h1>
    <div class="main__title">
        <p class="main__ttl">受付の際はこちらをご提示ください</p>
    </div>
    <div class="qr-code"style="text-align: center;">
        {!! $qrCode ?? '' !!}
    </div>
    <div class="reservation-info"style="text-align: center;">
        <h2>{{ $reservationData['予約者名'] }}様、本日のご予約情報</h2>
        <p>予約ID: {{ $reservationData['ご予約ID'] }}</p>
        <p>予約日: {{ $reservationData['予約日'] }}</p>
        <p>予約時間: {{ $reservationData['予約時間'] }}</p>
        <p>人数: {{ $reservationData['人数'] }}</p>
        <p>店舗ID: {{ $reservationData['店舗ID'] }}</p>
        <p>店舗名: {{ $reservationData['店舗名'] }}</p>      
    </div>
</div>
@endsection


