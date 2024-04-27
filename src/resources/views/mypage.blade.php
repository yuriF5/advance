@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <div class="mypage__wrap">
    <div class="reservation__wrap">
        <div class="reservation__tab">
            <label class="reservation__title hover__color--blue">
                <input type="radio" name="tab" class="reservation__title-input" checked>
                予約状況
            </label>
            <div class="reservation__content-wrap">
                @foreach ($reservations as $reservation)
                    <div class="reservation__content">
                        <div class="reservation__header">
                            <p class="header__title reservation__header__title">予約{{ $loop->iteration }}</p>
                            <div class="reservation__header-button">
                                <form action="{{ route('reservation.edit',$reservation) }}" method="get" class="header__form">
                                    <button type="submit" class="form__button--edit" onclick="return confirmEdit()" title="予約変更">
                                        <img src="{{ asset('images/edit.svg') }}" alt="予約変更" class="form__button-img">
                                    </button>
                                </form>
                                <form action="{{ route('reservation.destroy',$reservation) }}" method="post"  class="header__form">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="form__button--cancel" onclick="return confirmCancel()" title="予約キャンセル">
                                        <img src="{{ asset('images/batsu.svg') }}" alt="予約キャンセル" class="form__button-img">
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
                                <td class="table__item">{{ $reservation->number }}人</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>

            <label class="reservation__title hover__color--steelblue">
                <input type="radio" name="tab" class="reservation__title-input">
                予約履歴
            </label>
            <div class="reservation__content-wrap">
                @foreach ($histories as $reservation)
                    <div class="reservation__content reservation__content--steelblue">
                        <div class="reservation__header">
                            <p class="header__title reservation-history__header__title">履歴{{ $loop->iteration }}</p>
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
                    </div>
                @endforeach
            </div>

            
    <div class="favorite__wrap">
        <p class="favorite__title">お気に入り店舗</p>
       
    </div>
</div>
@endsection