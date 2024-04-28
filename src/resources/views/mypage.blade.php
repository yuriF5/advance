@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <div class="mypage__wrap">
    <div class="reservation__wrap">
        
            <div class="reservation__content-wrap">
                @foreach ($reservations as $reservation)
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
                    </div>
                @endforeach
            </div>
        </div>
    <div class="favorite__wrap">
        <p class="favorite__title">お気に入り店舗</p>
    </div>
</div>
@endsection