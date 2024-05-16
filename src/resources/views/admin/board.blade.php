@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">
@endsection

@section('content')
    <div class="auth__header">
        店舗代表者user登録
    </div>
    <form action="/admin/register" method="post" class="form__item">
        @csrf
        <div class="form__item-user">
            <input type="text" class="form__input-item" name="name" placeholder="店舗代表者名" value="{{ old('name') }}">
        </div>
        <div class="error__item">
            @error('name')
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
            <input type="checkbox" class="key" name="role[]" value="1" id="role_1">
            <label for="role_1">店舗代表者は必ずチェック</label>
        </div>

        <button type="submit" class="form__item-button">登録</button>
    </form>
</div>
@endsection