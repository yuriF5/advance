@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ご予約のQRコード</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ route('show.qrcode', ['reservationId' => $reservationId]) }}" alt="QR Code">
            </div>
        </div>
    </div>
@endsection