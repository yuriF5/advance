<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header class="header__l">
        <div class="header__icon">
            <input id="header__input" class="header__hidden" type="checkbox">
            <label for="header__input" class="header__open"><span></span></label>
            <nav class="header-nav__content">
                <ul class="header-nav">
                    @if (Auth::check())
                        @if( 0 == Auth::user()->role )
                        <li class="header-nav__item"><a class="header-nav__link" href="/">お知らせ・管理者一覧へ</a></li>                    
                        <li class="header-nav__item"><a class="header-nav__link" href="/">レビュー管理一覧へ</a></li>
                        <li class="header-nav__item">
                            <form class="form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="header-nav__link_b" style="background:none; border:none; padding:0; color:blue; cursor:pointer;">ログアウト</button>
                            </form>
                        </li>
                        @endif
                        @if( 1 == Auth::user()->role )
                        <li class="header-nav__item"><a class="header-nav__link" href="">予約者管理一覧へ</a></li>
                        <li class="header-nav__item"><a class="header-nav__link" href="/login">店舗情報編集へ</a></li>
                        <li class="header-nav__item"><a class="header-nav__link" href="/login">新規店舗登録へ</a></li>
                        <form class="form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="header-nav__link_b" style="background:none; border:none; padding:0; color:blue; cursor:pointer;">ログアウト</button>
                            </form>
                        @endif
                    @else
                    <li class="header-nav__item"><a class="header-nav__link" href="/login">Admin Loginへ</a></li>
                    <li class="header-nav__item"><a class="header-nav__link" href="/login">User Loginへ</a></li>
                </ul>
            </nav>
            <div class="header__logo">Rase</div>
        </div>
        @yield('header')
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>