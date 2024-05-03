@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="content__wrap">
        <p class="content__text">
            店舗代表者の登録が完了しました。
        </p>
        <a class="content__button" href="/">戻る</a>
    </div>
@endsection