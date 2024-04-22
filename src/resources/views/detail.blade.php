<!-- 飲食店舗詳細page -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="detail__wrap">
        <div class="detail__header">
            <div class="header__title">
                <a href="{{ $backRoute }}" class="header__back"><</a>
                <span class="header__shop-name">{{ $shop->name }}</span>
            </div>
        </div>
        <div class="detail__image">
            <img src="{{ $shop->image_url }}" alt="イメージ画像" class="detail__image-img">
        </div>
    </div>
@endsection