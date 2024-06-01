@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<p class="user__name">{{ Auth::user()->name }}さん</p>
<div class="mypage__wrap">
    <div class="reservation__wrap">
        <div class="reservation__title">
        <p class="reservation__title_p">ご予約状況</p>
        </div>
            <div class="reservation__content-wrap">
                @foreach ($reservations->sortBy('date') as $reservation)
                    @if (strtotime($reservation->date) > strtotime(date('Y-m-d')) || (strtotime($reservation->date) == strtotime(date('Y-m-d')) && strtotime($reservation->time) >= strtotime(date('H:i:s'))))
                    <div class="reservation__content">
                        <div class="reservation__header">
                            <p class="header__title reservation__header__title">予約{{ $loop->iteration }}</p>
                            <div class="reservation__header_button">
                                <form action="{{ route('reservation.edit',$reservation) }}" method="get" class="header__form">
                                    <button type="submit" class="form__button--edit" onclick="return confirmEdit()" title="予約変更">
                                        予約変更&#x1F556;
                                    </button>
                                </form>
                                <form action="{{ route('reservation.destroy',$reservation) }}" method="post"  class="header__form">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="form__button--cancel" onclick="return confirmCancel()" title="予約キャンセル">
                                        予約キャンセル&#x274E;
                                    </button>
                                </form>
                            </div>
                        </div>
                        <table class="reservation__table">
                            <tr>
                                <th class="table__header">Shop</th>
                                <td class="table__item">{{ $reservation->shop->name }}</td>
                            </tr>
                            <tr>
                                <th class="table__header">Date</th>
                                <td class="table__item">{{ $reservation->date }}</td>
                            </tr>
                            <tr>
                                <th class="table__header">Time</th>
                                <td class="table__item">{{ date('H:i',strtotime($reservation->time)) }}</td>
                            </tr>
                            <tr>
                                <th class="table__header">Number</th>
                                <td class="table__item">{{ $reservation->number_of_people }}人</td>
                            </tr>
                        </table>
                        <div class="reservation__footer_button">
                            <form method="GET" action="/code">
                            <input type="hidden" name="reservation_id" value="{{ $reservation['id'] }}"><form method="GET" action="/code">
                            <button type="submit" class="form__button--qr">QRコード</br>来店時にかざす
                            </button>
                            </form>
                            </form>
                                <a class="form__button--pay" href="{{ route('payment.create')}}">ネット</br>決済&#128179;</a>
                        </div>
                    </div>
                    @endif
                @endforeach
                
            </div>
        </div>
    <div class="favorite__wrap">
        <div class="reservation__title">
            <p class="favorite__title_p">お気に入り店舗</p>
        </div>
        <div class="mobile-favorite__wrap">
            <div class="favorite__wrap_c">
                @foreach ($shops as $shop)
                <div class="shop__content">
                    @if (filter_var($shop->image_url, FILTER_VALIDATE_URL))
                    <img class="shop__image" src="{{ $shop->image_url }}" alt="{{ $shop->name }}"width="100%">
                    @else
                    <img class="shop__image" src="{{ asset('storage/'.$shop->image_url) }}" alt="{{ $shop->name }}"width="100%">
                    @endif
                        <div class="shop__item">
                            <span class="shop__title">{{ $shop->name }}</span>
                            <div class="shop__tag">
                                <p class="shop__tag-info">#{{ $shop->area->name }}</p>
                                <p class="shop__tag-info">#{{ $shop->genre->name }}</p>
                            </div>
                            <div class="shop__button">
                                <a href="/detail/{{ $shop->id }}?from=mypage" class="shop__button-detail">詳しくみる</a>
                            @if(in_array($shop->id,$favorites))
                                <form action="{{ route('unfavorite',$shop) }}" method="post" class="shop__button-favorite">
                                    @csrf
                                    @method('delete')
                                        <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除"><img class="favorite__btn-image" width="30px"src="{{ asset('images/heart-solid.svg') }}"alt="">
                                        </button>
                                </form>
                            @endif
                            </div>      
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection