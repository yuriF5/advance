@extends('layouts.app')


@section('css')
    
@endsection

@section('content')
<div class="qr-code-container">
    <h1>{{ Auth::user()->name }}さん 予約情報QRコード</h1>
    <img class="qr-code" src="data:image/svg+xml;base64,{{ base64_encode($qrCode) }}" alt="QRコード">
</div>
<style>
    /* QRコードを中央に配置するためのスタイル */
    .qr-code-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .qr-code {
        max-width: 300px; /* QRコードの最大幅を設定 */
    }
</style>
@endsection