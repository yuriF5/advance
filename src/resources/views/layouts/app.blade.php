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
                    <li class="header-nav__item"><a class="header-nav__link" href="/">Home</a></li>
                    @if (Auth::check())
                    <li class="header-nav__item"><a class="header-nav__link" href="/mypage">Mypage</a></li>
                    <li class="header-nav__item">
                        <form class="form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="header-nav__link_b" style="background:none; border:none; padding:0; color:blue; cursor:pointer;">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="header-nav__item"><a class="header-nav__link" href="/register">Registration</a></li>
                    <li class="header-nav__item"><a class="header-nav__link" href="/auth/login">Login</a></li>
                    @endif
                    @if (Auth::check())
                    @if( 0 == Auth::user()->role )
                        <li class="header-nav__item"><a class="header-nav__link" href="/admin/email_send">お知らせへ</a></li> 
                        <li class="header-nav__item"><a class="header-nav__link" href="/admin/board">店舗代表者user登録へ</a></li>
                    @endif
                    @if( 1 == Auth::user()->role )
                        <li class="header-nav__item"><a class="header-nav__link" href="/admin/reservation">予約一覧へ</a></li>
                        <li class="header-nav__item"><a class="header-nav__link" href="/admin/create">店舗情報の新規登録</a></li>
                        <li class="header-nav__item"><a class="header-nav__link" href="/">店舗一覧から</br>店舗修正へ</a></li> 
                    @endif
                    @endif
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
