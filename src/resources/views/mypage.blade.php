@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <p class="user__name">{{ Auth::user()->name }}さん</p>
    <div class="mypage__wrap">
    <div class="reservation__wrap">
        <div class="reservation__tab">
            <label class="reservation__title hover__color--blue">
                <input type="radio" name="tab" class="reservation__title-input" checked>
                予約状況
            </label>
      
             

            <label class="reservation__title hover__color--steelblue">
                <input type="radio" name="tab" class="reservation__title-input">
                予約履歴
            </label>
            <div class="reservation__content-wrap">

                    <div class="reservation__content reservation__content--steelblue">
                        <div class="reservation__header">
                            <p class="header__title reservation-history__header__title">履歴 </p>
                        </div>
                        <table class="reservation__table">
                            <tr>
                                <th class="table__header">Shop</th>
                                <td class="table__item"></td>
                            </tr>
                            <tr>
                                <th class="table__header">Date</th>
                                <td class="table__item"></td>
                            </tr>
                            <tr>
                                <th class="table__header">Time</th>
                                <td class="table__item"></td>
                            </tr>
                            <tr>
                                <th class="table__header">Number</th>
                                <td class="table__item">人</td>
                            </tr>
                        </table>
                    </div>
 
            </div>

            <label class="reservation__title hover__color--orange mobile-favorite__title">
                <input type="radio" name="tab" class="reservation__title-input">お気に入り店舗
            </label>
            <div class="reservation__content-wrap mobile-favorite__wrap">
              
                    <div class="shop__content">
                        <img class="shop__image" src="image_url }}" alt="イメージ画像">
                        <div class="shop__item">
                            <span class="shop__title"></span>
                            <div class="shop__tag">
                                <p class="shop__tag-info">#</p>
                                <p class="shop__tag-info">#</p>
                            </div>
                            <div class="shop__button">
                                <a href= ""class="shop__button-detail">詳しくみる</a>
                             
                                    <form action="" method="post" class="shop__button-favorite">
                                        @csrf
                                        @method('delete')
                                            <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除">
                                                <img class="favorite__btn-image" src="{{ asset('images/heart_color.svg') }}">
                                            </button>
                                    </form>
                     
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>

</div>
@endsection