@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/de.css') }}">
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
            @if (filter_var($shop->image_url, FILTER_VALIDATE_URL))
                <img class="detail__image-img" src="{{ $shop->image_url }}" alt="{{ $shop->name }}"width="100%">
            @else
                <img class="detail__image-img" src="{{ asset('storage/'.$shop->image_url) }}" alt="{{ $shop->name }}"width="100%">
            @endif
        </div>
        <div class="detail__tag">
            <p class="detail__tag-info">#{{ $shop->area->name }}</p>
            <p class="detail__tag-info">#{{ $shop->genre->name }}</p>
        </div>
        <div class="detail__outline">
            <p class="detail__outline-text">{{ $shop->description }}</p>
        </div>
    </div>
    
    <h1>店舗情報の更新</h1>
    <div class="shop_header">
        <form method="POST" action="/update/shop" enctype="multipart/form-data">
            @csrf
            <div>
            {{ session('message') }}
            </div>
            <input type="hidden" name="id" value="{{ $shop['id'] }}">
            <div>
                <label for="name" class="block">店舗名</label>
                    <input type="text" name="name" class="form__input-item" value="{{ old('name', $shop['name']) }}">
                <div class="error__item">
                @error('name')
                    <span class="error__message">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div>
            <label for="area" class="block">地域</label>
            <select name="area_id" class="form__input-item" id="area" required>
                <option value="">選択してください</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}" {{ old('area_id', $shop->area_id) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
            <div class="error__item">
                @error('area')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <label for="genre" class="block">ジャンル</label>
            <select name="genre_id" class="form__input-item" id="genre" required>
                    <option value="">選択してください</option>
                    @foreach($genres ?? [] as $genre)
                        <option value="{{ $genre->id }}" {{ old('genre_id', $shop->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            <div class="error__item">
                @error('genre')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
        </div>
            <div>
                <label for="description" class="block">店舗概要</label>
                    <textarea name="description" class="form__input-item"rows="10">{{ old('description', $shop['description']) }}</textarea>
                <div class="error__item">
                @error('description')
                    <span class="error__message">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <div>
                <label for="image_file" class="block">画像の変更</label>
                    <input type="file" name="image_file"  class="form__input-item">
                <div class="error__item">
                @error('image_file')
                <span class="error__message">{{ $message }}</span>
                @enderror
                </div>
            </div>
            <button type="submit" class="form__item-button">更新</button>
        </form>
    </div>
</div>
@endsection