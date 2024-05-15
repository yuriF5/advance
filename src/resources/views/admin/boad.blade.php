@extends('layouts.appad')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_list.css') }}">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <!--お知らせメール作成-->
        <div>
            <h1 class="text-lg">お知らせメール作成</h1>
            <a class="" href="/admin/email_send">作成</a>
        </div>

        <div class="auth__wrap">
        <div class="auth__header">
            管理代表者user登録
        </div>
        <form action="" method="post" class="form__item">
            @csrf
            <div class="form__item-user">
                <input type="text" class="form__input-item" name="username" placeholder="店舗代表者名" value="{{ old('username') }}">
            </div>
            <div class="error__item">
                @error('username')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form__item-mail">
                <input type="email" class="form__input-item" name="email" placeholder="店舗用メールアドレス" value="{{ old('email') }}">
            </div>
            <div class="error__item">
                @error('email')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form__item-key">
                <input type="password" class="form__input-item" name="password" placeholder="店舗用 Password">
            </div>
            <div class="error__item">
                @error('password')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form__item-key">
                <input type="checkbox" class="form__input-item" name="role[]" value="0" id="role_0">
                <label for="role_0">管理者</label>
                <input type="checkbox" class="form__input-item" name="role[]" value="1" id="role_0">
                <label for="role_1">店舗代表者</label>
            </div>

            <button type="submit" class="form__item-button">登録</button>

        </form>
    </div>
@endsection