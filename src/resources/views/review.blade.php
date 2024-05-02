@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review_form">
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
                                    <img class="favorite__btn-image" width="40px" src="{{ asset('images/heart-solid.svg') }}" alt="">
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favorite', $shop) }}" method="post" enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                                @csrf
                                <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                                    <img class="favorite__btn-image" width="40px" src="{{ asset('images/heart-regular (1).svg') }}" alt="お気に入り登録">
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="review_input">
        @if(in_array($shop->id, $reviews))
    <div class="review_history">
        <p>過去の投稿内容:</p>
        @foreach($Reviews as $review)
            <div class="review_item">
                <p>投稿日付: {{ $review->created_at }}</p>
                <p>店名: {{ $review->shop->name }}</p>
                <p>評価: {{ $review->star }}</p>
                <p>コメント: {{ $review->comment }}</p>
                <div class="review_buttons">
                    <form action="{{ route('review.delete', $review->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                    <a href="">内容変更</a>
                </div>
            </div>
        @endforeach
    </div>
@else
        <form action="{{ route('review.store', $shop->id) }}" method="post">
            @csrf
            <div class="review_star">
                <p>体験を評価してください</p>
                <div class="flex flex-col">
                    <div>
                        <input type="radio" id="star5" name="star" value="5" class="hidden peer">
                        <label for="star5" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★</label>
                    </div>
                    <div>
                        <input type="radio" id="star4" name="star" value="4" class="hidden peer">
                        <label for="star4" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★★</label>
                    </div>
                    <div>
                        <input type="radio" id="star3" name="star" value="3" class="hidden peer">
                        <label for="star3" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★★★</label>
                    </div>
                    <div>
                        <input type="radio" id="star2" name="star" value="2" class="hidden peer">
                        <label for="star2" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★★★★</label>
                    </div>
                    <div>
                        <input type="radio" id="star1" name="star" value="1" class="hidden peer">
                        <label for="star1" class="relative py-0 px-[5px] text-gray-200 cursor-pointer text-[35px] hover:text-blue-600 peer-hover:text-blue-600 peer-checked:text-blue-600">★★★★★</label>
                    </div>
                </div>
                <div class="error">
                    @error('star')
                        ※{{ $message }}
                    @enderror
                </div>
            </div>
            <div class="review_write_comment">
                <p class="tittle">コメント</p>
                <div>
                    <textarea name="comment" class="comment" onkeyup="ShowLength(value)"></textarea>
                    <div class="text-xs text-end">
                        <span id="inputlength">0</span>
                        <span>/400(最大文字数)</span>
                    </div>    
                    <script>
                    function countCharacters(element) {
                        var maxLength = 400;
                        var currentLength = element.value.length;
                        var remainingLength = maxLength - currentLength;
                        document.getElementById("inputlength").textContent = currentLength;
                        if (remainingLength < 0) {
                            document.getElementById("inputlength").style.color = "red";
                        } else {
                            document.getElementById("inputlength").style.color = "inherit";
                        }
                    }
                    </script>
                    <div class="error">
                        @error('comment')
                            ※{{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="review_write_footer">
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="border_text_b">
                    <button type="submit" class="goal">口コミを投稿</button>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection