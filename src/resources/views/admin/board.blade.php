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
        <div class="form__item-shop">
        <select name="shop_id" class="form__input-item">
            <option value="">店舗選択</option>
            @foreach ($shops as $shop)
                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
            @endforeach
        </select>
        <div class="error__item">
            @error('shop')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>
        </div>
        <div class="form__item-name">
            <select name="user_id" class="form__input-item">
                <option value="">代表者</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            </select>
        </div>
        <div class="error__item">
            @error('name')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="form__item-button">登録</button>
    </form>
</div>

@endsection