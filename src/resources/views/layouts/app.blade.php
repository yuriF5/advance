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
        <header class="header">
            <div class="header__icon">
                <input id="header__input" class="hidden" type="checkbox">
                <label for="header__input" class="open" ><span></span></label>
                    <nav class="nav__content">
                        <ul class="header-nav">
                            <li class="header-nav__item"><a class="header-nav__link" href="/">Home</a></li>
                        @if (Auth::check())
                            <li class="header-nav__item"><a class="header-nav__link" href="/mypage">Mypage</a>

                            <li class="header-nav__item"><a class="header-nav__link" href="/logout">Logout</a></li>
                        @else
                            <li class="header-nav__item"><a class="header-nav__link" href="/register">Registration</a></li>
                            <li class="header-nav__item"><a class="header-nav__link" href="/login">Login</a></li>
                        @endif
                        </ul>
                    </nav>
                </div>
                <div class="header__logo">Rase</div>
            </div>
            @yield('header')
        </header>

        <main>
            @yield('content')
        </main>
    </body>

</html>