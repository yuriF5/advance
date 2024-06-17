@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="shop__wrap">
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="shop__header">
        新店舗登録
    </div>
    <form action="/add/shop" method="post" class="form__item"enctype="multipart/form-data">
        @csrf
        <div>
        <label for="description" class="block">店舗名</label>
            <input type="text" class="form__input-item" name="name" placeholder="New Shop Name" value="{{ old('name') }}">
        </div>
        <div class="error__item">
            @error('name')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>
        <div>
        <label for="area" class="block">地域</label>
            <select name="area" class="form__input-item" id="area">
                <option value="" {{ old('area') == '' ? 'selected' : '' }}>選択してください</option>
                <option value="1" {{ old('area') == '13' ? 'selected' : '' }}>東京</option>
                <option value="2" {{ old('area') == '27' ? 'selected' : '' }}>大阪</option>
                <option value="3" {{ old('area') == '40' ? 'selected' : '' }}>福岡</option>
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
            <input type="file" name="image_file" id="image_file" class="form__input-item">
            <p>画像プレビューはこちら</p>
            <div id="image_preview" class="image-preview" style="margin-top: 20px;">
                <img id="preview" src="" alt="画像プレビュー"style="max-width: 25%; height: auto; display: none;">
            </div>
        </div>
        <div class="error__item">
            @error('image_file')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="form__item-button">登録</button>

    </form>
</div>
    <script>
        document.getElementById('image_file').addEventListener('change', function(event) {
            var input = event.target;

            // ファイルが選択されている場合
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // 画像を表示
                };

                reader.readAsDataURL(input.files[0]); // 画像ファイルを読み込む
            }
        });
    </script>

@endsection