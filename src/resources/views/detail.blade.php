<!-- 飲食店舗詳細page -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="detail__wrap">
        <div class="detail__header">
            <div class="header__title">
                <a href="{{ $backRoute }}" class="header__back">&lt;</a>
                <span class="header__shop-name">{{ $shop->name }}</span>
            </div>
        </div>
        <div class="detail__image">
            <img src="{{ $shop->image_url }}" alt="イメージ画像" class="detail__image-img">
        </div>
        <div class="detail__tag">
            <p class="detail__tag-info">#{{ $shop->area->name }}</p>
            <p class="detail__tag-info">#{{ $shop->genre->name }}</p>
        </div>
        <div class="detail__outline">
            <p class="detail__outline-text">{{ $shop->description }}</p>
        </div>
    </div>

    <div class="reservation__form">
        <form action="{{ route('reservation', $shop) }}" method="post" class="reservation__wrap">
            @csrf
            <div class="form__item">
                <label for="date"></label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" required>
            </div>
            <div class="error__item">
                @error('date')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__item">
                <label for="time"></label>
                <select name="time" id="time" required>
                    <option value="" disabled selected>-- 時間を選択してください --</option>
                    @foreach (['20:00', '20:30', '21:00', '21:30', '22:00'] as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
                <div class="error__item">
                    @error('time')
                        <span class="error__message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form__item">
                <label for="number"></label>
                <select name="number" id="number" required>
                    <option value="" disabled selected>-- 人数を選択してください --</option>
                    @foreach (range(1, 5) as $number)
                        <option value="{{ $number }}">{{ $number }}人</option>
                    @endforeach
                </select>
                <div class="error__item">
                    @error('number')
                        <span class="error__message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="reservation__group">
                <div class="reservation__area">
                    <table class="reservation__table">
                        <tr>
                            <th class="table__header">Shop</th>
                            <td class="table__item">{{ $shop->name }}</td>
                        </tr>
                        <tr>
                            <th class="table__header">Date</th>
                            <td class="table__item" id="dateId"></td>
                        </tr>
                        <tr>
                            <th class="table__header">Time</th>
                            <td class="table__item" id="timeId"></td>
                        </tr>
                        <tr>
                            <th class="table__header">Number</th>
                            <td class="table__item" id="numberId"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="reservation__button">
                @if (Auth::check())
                    <button type="submit" class="reservation__button">予約する</button>
                @else
                    <p>予約するには<a href="/register" class="reservation__button-link">会員登録</a>または<a href="/login" class="reservation__button-link">ログイン</a>が必要です</p>
                @endif
            </div>
        </form>
    </div> 
</div>

@endsection