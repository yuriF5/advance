<!-- 飲食店舗詳細page -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="detail__wrap">
        <div class="detail__header">
            <div class="header__title">
                <a href="{{ $backRoute }}" class="header__back"><</a>
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

    
                <div class="error__item">
                    @error('date')
                        <span class="error__message">{{ $message }}</span>
                    @enderror
                </div>
                <select name="time" class="form__item">
                    <option value="" {{ request()->is('*edit*') && isset($reservation->time) ? '' : 'selected' }}
                        disabled>-- 時間を選択してください --</option>
                    @foreach (['20:00', '20:30', '21:00', '21:30', '22:00'] as $time)
                        <option value="{{ $time }}"
                            {{ request()->is('*edit*') && $time == date('H:i', strtotime($reservation->time)) ? 'selected' : '' }}>
                            {{ $time }}
                        </option>
                    @endforeach
                </select>
                <div class="error__item">
                    @error('time')
                        <span class="error__message">{{ $message }}</span>
                    @enderror
                </div>
                <select name="number" class="form__item">
                    <option value="" {{ request()->is('*edit*') && isset($reservation->time) ? '' : 'selected' }}
                        disabled>--人数を選択してください --</option>
                    @foreach (range(1, 5) as $number)
                        <option value="{{ $number }}"
                            {{ request()->is('*edit*') && $number == $reservation->number ? 'selected' : '' }}>
                            {{ $number }}人
                        </option>
                    @endforeach
                </select>
                <div class="error__item">
                    @error('number')
                        <span class="error__message">{{ $message }}</span>
                    @enderror
                </div>
            </div>


@endsection