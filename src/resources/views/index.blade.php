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
                        <button type="submit" class="search__item-button">
                            <img src="{{ asset('images/magnifying-glass-solid.svg') }}" width="10" alt="検索">
                        </button>                    
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
                @if(Auth::check() && Auth::user()->role == 1)
                <a class="shop__button-detail" href="{{ url('/admin/update/'.$shop->id) }}">店舗修正</a>
                @endif
                @if (Auth::check())
                    @if (in_array($shop->id, $favorites))
                        <form action="{{ route('unfavorite', $shop) }}" method="post"
                            enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                            @csrf
                            @method('delete')
                            <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除">
                                <img class="favorite__btn-image" width="40px"src="{{ asset('images/heart-solid.svg') }}"alt="">
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favorite', $shop) }}" method="post"
                            enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                            @csrf
                            <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                                <img class="favorite__btn-image" width="40px"src="{{ asset('images/heart-regular (1).svg') }}"alt="お気に入り登録">
                            </button>
                        </form>
                    @endif
                @else
                    <button type="button" onclick="location.href='/login'" class="shop__button-favorite-btn">
                        <img class="favorite__btn-image" width="40px"src="{{ asset('images/heart-regular (1).svg') }}"alt="お気に入り登録">
                    </button>
                @endif
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection