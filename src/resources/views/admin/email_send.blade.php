@extends('layouts.appad')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/email_send.css') }}">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="email_send__wrap">
        <div class="email_send__header">
            メール作成
        </div>

        <div class="email_send__content-wrap">
            <form action="{{route('send.notification') }}" method="post" class="email_send__form">
                @csrf
                <div class="email_send__content">
                    <div class="email_send__title vertical-center">
                        宛先
                    </div>
                    <div class="email_send__area">
                        <select name="destination" id="destination" size="1" class="destination__content-select">
                            <option value="all">全員</option>
                            <option value="user">ユーザー</option>
                            <option value="writer">店舗代表者</option>
                            <option value="admin">管理者</option>
                        </select>
                    </div>
                </div>

                <div class="email_send__content email_send__content-textarea">
                    <div class="email_send__title">
                        本文
                    </div>
                    <div class="email_send__area">
                        <textarea class="email_send__textarea" name="message" rows="10" required></textarea>
                    </div>
                </div>
                <div class="form__button">
                    <a href="/admin/boad" class="back__button">戻る</a>
                    <button type="submit" class="form__button-btn">メール送信</button>
                </div>
            </form>
        </div>
    </div>
@endsection
