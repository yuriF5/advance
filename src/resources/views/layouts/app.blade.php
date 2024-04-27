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
                            <button type="submit" class="header-nav__link" style="background:none; border:none; padding:0; color:blue; cursor:pointer;">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="header-nav__item"><a class="header-nav__link" href="/register">Registration</a></li>
                    <li class="header-nav__item"><a class="header-nav__link" href="/login">Login</a></li>
                    @endif
                </ul>
            </nav>
            <div class="header__logo">Rase</div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @yield('header')
</body>

</html>
