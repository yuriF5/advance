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
                    
                        <li class="header-nav__item"><a class="header-nav__link" href="/admin/boad">お知らせ・管理者一覧へ</a></li>                    
                        <li class="header-nav__item"><a class="header-nav__link" href="">レビュー管理一覧へ</a></li>
                        <li class="header-nav__item">
                            
                        </li>
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