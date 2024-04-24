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
            <!-- カード一覧 -->
        <div class="flex justify-between flex-wrap">
            @foreach ($shops as $shop)
            <div class="w-56 bg-white rounded-md shadow-md mb-4">
                <div>
                    <img class="w-full h-28 object-cover rounded-t-md" src="{{ $shop['image_url'] }}">
                </div>
                <div class="p-3">
                    <h2 class="font-bold">{{ $shop['name'] }}</h2>
                    <div class="text-xs">
                        <span>#{{ $shop['region'] }}</span>
                        <span>#{{ $shop['genre'] }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <a class="text-xs h-6 rounded-md bg-blue-600 text-white px-3 pt-1" href="{{ url('/detail/'.$shop['id']) }}">詳しくみる</a>
                        @if( Auth::check() )
                            <form method="POST" action="{{ url('/favorite') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                                <button class="text-2xl {{ $shop['favorite'] ? 'text-red-500' : 'text-gray-100' }}" type="submit">&#9829;</button>
                            </form>
                        @endif
                    </div>
                </div>            
            </div>
            @endforeach
@endsection