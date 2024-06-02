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

    <div class="reservation__form">
        <h2 class="reservation__title">予約変更</h2>
        <form action="{{ route('reservation', $shop) }}" method="post" class="reservation__wrap">
            @csrf
            <div class="form__item">
                <label for="date"><input type="date" id="date" name="date" value="{{ $reservation->date }}" required></label>
            </div>
            <div class="error__item">
                @error('date')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form__item">
                <label for="time">
                    <select name="time" id="time" required>
                    <option value="" disabled>-- 変更する時間を選択してください --</option>
                    @foreach ($availableTimes as $timeOption)
                        <option value="{{ $timeOption }}" {{  $reservation->time== $timeOption ? 'selected' : '' }}>{{ $timeOption }}</option>
                    @endforeach
                    </select>
                </label>
            </div>
            <div class="error__item">
                @error('time')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form__item">
                <label for="number">
                <select name="number" id="number" required>
                    <option value="" disabled>-- 変更する人数を選択してください --</option>
                    @foreach (range(1, 5) as $number)
                        <option value="{{ $number }}" {{ $reservation->number_of_people== $number ? 'selected' : '' }}>{{ $number }}人</option>
                    @endforeach
                </select></label>
            </div>  
            <div class="error__item">
                @error('number')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="reservation__group">
                <div class="reservation__area">
                    <table class="reservation__table">
                        <tr>
                            <th class="table__header">Shop</th>
                            <td class="table__item">{{ $shop->name }}</td>
                        </tr>
                        <tr>
                            <th class="table__header">Date</th>
                            <td class="table__item" id="dateId">{{ $reservation->date }}</td>
                        </tr>
                        <tr>
                            <th class="table__header">Time</th>
                            <td class="table__item" id="timeId">{{ $reservation->time }}</td>
                        </tr>
                        <tr>
                            <th class="table__header">Number</th>
                            <td class="table__item" id="numberId">{{ $reservation->number_of_people}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="reservation__button">
                    <button type="submit" class="reservation__button">予約変更を更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#time, #number').change(function() {
            var time = $('#time').val();
            var number = $('#number').val();

            var timeText = time ? time : '--';
            var numberText = number ? number + '人' : '--';

            $('#timeId').text(timeText);
            $('#numberId').text(numberText);
        });
        $('#date').change(function() {
            var date = $('#date').val();
            $('#dateId').text(date);
        });
    });
</script>
