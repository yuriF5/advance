@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <p class="user__name">{{ Auth::user()->name }}さん</p>
    <div class="mypage__wrap">
    <div class="reservation__wrap">
        <div class="reservation__tab">
            <label class="reservation__title hover__color--blue">
                予約状況
            </label>
            <div class="reservation__content-wrap">
                    <div class="reservation__content">
                        <div class="reservation__header">
                            <p class="header__title reservation__header__title">予約</p>
                        </div>
                        <table class="reservation__table">
                            <tr>
                                <th class="table__header">Shop</th>
                                <td class="table__item"></td>
                            </tr>
                            <tr>
                                <th class="table__header">Date</th>
                                <td class="table__item"></td>
                            </tr>
                            <tr>
                                <th class="table__header">Time</th>
                                <td class="table__item"></td>
                            </tr>
                            <tr>
                                <th class="table__header">Number</th>
                                <td class="table__item">人</td>
                            </tr>
                        </table>
                    </div>
            </div>
@endsection