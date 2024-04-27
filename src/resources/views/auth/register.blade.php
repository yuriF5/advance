@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="auth__wrap">
        <div class="auth__header">
            Registration
        </div>
        <form action="{{ route('register') }}" method="post" class="form__item">
            @csrf
            <div class="form__item-user">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22" height="22"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                <input type="text" class="form__input-item" name="name" placeholder="Username" value="{{ old('name') }}">
            </div>
            <div class="error__item">
                @error('name')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__item-mail">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22" ><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
                <input type="email" class="form__input-item" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="error__item">
                @error('email')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__item-key">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22"><path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>
                <input type="password" class="form__input-item" name="password" placeholder="Password">
            </div>
            <div class="error__item">
                @error('password')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div><a href="{{ route('thanks') }}">
            <button type="submit" class="form__item-button">登録</button></a>
        </form>
    </div>
@endsection