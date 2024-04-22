@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
    <form class="header__right" action="/" method="get">
        <div class="header__search">
            <label class="select-box__label">
                <select name="area" class="select-box__item">
                    <option value="">All area</option>
                    

                </select>
            </label>

            <label class="select-box__label">
                <select name="genre" class="select-box__item">
                    <option value="">All genre</option>

                        
                </select>
            </label>

            <div class="search__item">
                <div class="search__item-button"></div>
                <label class="search__item-label">
                    <input type="text" name="" class="search__item-input" placeholder="Search ..." value="">
                </label>
            </div>
        </div>
    </form> 
@endsection

@section('content')
    <div class="shop__wrap">
        <img class="shop__image" src="image_url" alt="イメージ画像">
        <div class="shop__item">
            <span class="shop__title">{{ $shop->name }}</span>
            <div class="shop__tag">
                <p class="shop__tag-info">#{{ $shop->area->name }}</p>
                <p class="shop__tag-info">#{{ $shop->genre->name }}</p>
            </div>
        </div>
    </div>
@endsection