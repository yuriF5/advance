<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
</head>
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('content')
<div class="login__content">
  <div class="login-form__heading">
    <h2>店舗情報</h2>
  </div>

 
</div>
@endsection
  <main>
    @yield('content')
  </main>
</body>

</html>