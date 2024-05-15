@extends('layouts.appad')

@section('css')
    <link rel="stylesheet" href="">
@endsection

@section('content')
<div class="auth__wrap">
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="auth__header">
        新店舗登録
    </div>
    <form action="/add/shop" method="post" class="form__item"enctype="multipart/form-data">
        @csrf
        <div>
        <label for="description" class="block">店舗名</label>
            <input type="text" class="form__input-item" name="name" placeholder="New Shop Name" value="{{ old('name') }}">
        </div>
        <div class="error__item">
            @error('username')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>
        <div>
        <label for="area" class="block">地域</label>
            <select name="area" class="form__input-item" id="area">
                <option value="" {{ old('genre') == '' ? 'selected' : '' }}>選択してください</option>
                <option value="1" {{ old('area') == '1' ? 'selected' : '' }}>東京</option>
                <option value="2" {{ old('area') == '2' ? 'selected' : '' }}>大阪</option>
                <option value="3" {{ old('area') == '3' ? 'selected' : '' }}>福岡</option>
            </select>
        </div>
        <div class="error__item">
            @error('area')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>

        <div>
        <label for="description" class="block">ジャンル</label>
            <select name="genre" class="form__input-item">
                <option value="" {{ old('genre') == '' ? 'selected' : '' }}>選択してください</option>
                <option value="1" {{ old('genre') == '1' ? 'selected' : '' }}>寿司</option>
                <option value="2" {{ old('genre') == '2' ? 'selected' : '' }}>焼肉</option>
                <option value="3" {{ old('genre') == '3' ? 'selected' : '' }}>居酒屋</option>
                <option value="4" {{ old('genre') == '4' ? 'selected' : '' }}>イタリアン</option>
                <option value="5" {{ old('genre') == '5' ? 'selected' : '' }}>ラーメン</option>
            </select>
        </div>
        <div class="error__item">
            @error('genre')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>

        <div>
        <label for="description" class="block">店舗概要</label>
            <textarea name="description" class="form__input-item">{{ old('description') }}</textarea>
        </div>
        <div class="error__item">
            @error('description')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>

        <div>
        <label for="image_file" class="block">画像ファイルの登録(アップロード)</label>
            <input type="file" name="image_file"  class="form__input-item">
        </div>
        <div class="error__item">
            @error('image_file')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="form__item-button">登録</button>

    </form>
</div>
@endsection