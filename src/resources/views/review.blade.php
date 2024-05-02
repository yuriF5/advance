@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')

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