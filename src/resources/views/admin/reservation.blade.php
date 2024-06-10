@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="container">
    <form action="{{ route('admin.reservation') }}" method="GET">
        @csrf
    <input type="text" name="user_search" placeholder="予約者名を検索">
    <button type="submit">検索</button>
    </form>
    <h1>予約一覧</h1>
    <table class="table_reservation">
        <tr class="table_reservation_tr">
            <th>予約者</th>
            <th>予約日</th>
            <th>予約時間</th>
            <th>予約人数</th>
        </tr>
        @foreach ($reservations as $reservation)
        <tr class="">
            <td class="wrap">{{ $reservation['user_name']}}</td>
            <td class="wrap">{{ $reservation['date']}}</td>
            <td class="wrap">{{ $reservation['time']}}</td>
            <td class="wrap">{{ $reservation['number_of_people']}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection