@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
    <form class="header__right" action="/" method="get">
        <div class="header__sort">
            <label class="select-box__label sort__label">
                
            </label>
        </div>

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
                    <input type="text" name="word" class="search__item-input" placeholder="Search ..." value="{{ request('word') }}">
                </label>
            </div>
        </div>
    </form>

    <div class="header__right--hidden">
        <div class="search__icon">
            <input id="drawer__input-search" class="drawer__hidden-search" type="checkbox">
            <label for="drawer__input-search" class="drawer__open-search"><span></span></label>
            <div class="overlay"></div>
            <div class="search__content">
                <form action="/" method="get" class="search__form">
                    <div class="search__select">
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
                    </div>

                    <div class="search__text">
                        <div class="search__item">
                            <div class="search__item-button"></div>
                            <label class="search__item-label">
                                <input type="text" name="word" class="search__item-input" placeholder="Search ..."
                                    value="}">
                            </label>
                        </div>
                    </div>

                    <div class="sort__select">
                        <label class="select-box__label sort__label">
                            <select name="sort" class="select-box__item sort__item">
                                <option value="random" >ランダム</option>
                                <option value="high_rating" >評価が高い順
                                </option>
                                <option value="low_rating">評価が低い順
                                </option>
                            </select>
                        </label>
                    </div>
                    <button type="submit" class="form__button">検索</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="shop__wrap">      
              <div class="shop__content">
                <img class="shop__image" src="_url }}" alt="イメージ画像">
                <div class="shop__item">
                    <span class="shop__title">shop->name</span>
                    <div class="shop__tag">
                        <p class="shop__tag-info">#$shop->area->name </p>
                        <p class="shop__tag-info"># $shop->genre->name </p>
                    </div>
                    <div class="shop__button">
                        <a href=""class="shop__button-detail">詳しくみる</a>
                        
                    </div>
                </div>
            </div>
     

        

    </div>
    
@endsection