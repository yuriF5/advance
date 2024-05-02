@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review__wrap">
        <div class="title__wrap">
            <p class="title__text">今回のご利用はいかがでしたか？</p>
            <div class="shop__content">
                <img class="shop__image" src="{{ $shop->image_url }}" alt="イメージ画像">
                <div class="shop__item">
                    <span class="shop__title">{{ $shop->name }}</span>
                    <div class="shop__tag">
                        <p class="shop__tag-info">#{{ $shop->area->name }}</p>
                        <p class="shop__tag-info">#{{ $shop->genre->name }}</p>
                    </div>
                    <div class="shop__button">
                        <a href="/detail/{{ $shop->id }}?from=index" class="shop__button-detail">詳しくみる</a>
                        @if (in_array($shop->id, $favorites))
                            <form action="{{ route('unfavorite', $shop) }}" method="post" enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                                @csrf
                                @method('delete')
                                <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除">
                                    <img class="favorite__btn-image" src="{{ asset('images/heart_color.svg') }}">
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favorite', $shop) }}" method="post" enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                                @csrf
                                <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                                    <img class="favorite__btn-image" src="{{ asset('images/heart.svg') }}">
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <h1>レビュー一覧</h1>

    <!-- レビューを表示する部分 -->
    @foreach($reviews as $review)
        <div>
            <p>評価: {{ $review->rating }}</p>
            <p>コメント: {{ $review->comment }}</p>
            <!-- 他のレビュー情報もここに表示 -->
        </div>
    @endforeach

    <!-- レビュー投稿フォーム -->
    <form action="{{ route('review.store') }}" method="post">
        @csrf
        <label for="rating">評価</label>
        <input type="number" name="rating" id="rating" min="1" max="5" required>
        <br>
        <label for="comment">コメント</label>
        <textarea name="comment" id="comment" rows="4" required></textarea>
        <br>
        <button type="submit">投稿</button>
    </form>
@endsection