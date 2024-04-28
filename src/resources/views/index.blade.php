@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('header')
<div class="header__right">
    <div class="search__icon">
        <div class="overlay"></div>
        <form class="header__search-form" action="/" method="get">
            @csrf
            <div class="header__search">
                <label class="select-box__label">
                    <select name="area" class="select-box__item">
                        <option value="">All area</option>
                        @foreach ($areas as $area)
                            <option class="select-box__option" value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="select-box__label">
                    <select name="genre" class="select-box__item">
                        <option value="">All genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="search__item">
                    <div class="search__item-button">
                    <span class="fill-gray-500 h-5 w-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                        </svg>
                    </span>
                </div>
                    <label class="search__item-label">
                        <input type="text" name="word" class="search__item-input" placeholder="Search ..." value="{{ request('word') }}">
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="shop__wrap">
@foreach ($shops as $shop)
    <div class="shop__content">
        <div>
            <img class="shop__image" src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
        </div>
        <div class="shop__item">
            <h2 class="shop__title">{{ $shop->name }}</h2>
            <div class="shop__tag">
                <span class="shop__tag-info">#{{ $areaNames[$shop->area_id] }}</span>
                <span class="shop__tag-info">#{{ $genreNames[$shop->genre_id] }}</span>
            </div>
            <div class="shop__button">
                <a class="shop__button-detail" href="{{ url('/detail/'.$shop->id) }}">詳しくみる</a>
                <img class="favorite__btn-image" width='30px' src="{{ asset('images/heart-regular (1).svg') }}">
            </div>
        </div>
    </div>

@endforeach
</div>
@endsection