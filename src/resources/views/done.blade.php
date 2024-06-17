@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="content__wrap">
        <p class="content__text">
            ご予約ありがとうございます。
        </p>
        <a class="form__button--pay" href="https://buy.stripe.com/test_bIY7wsgbccfA4RG004">決済先へ&#128179;</a>
        <a class="content__button" href="/mypage">戻る</a>
    </div>
@endsection