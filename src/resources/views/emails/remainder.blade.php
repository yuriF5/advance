{{ $user->name }}さん<BR>
こんにちは。ご予約の確認です。<BR>
店名: {{ $shop->name }}<BR>
日時: {{ $reservation->time }}<BR>
人数: {{ $reservation->number_of_people}}<BR>
ご来店をお待ちしております。<BR>
<!DOCTYPE html>
<html>
<head>
    <title>ご予約の確認です。</title>
</head>
<body>
<p>{{ $user->name }}さん<BR>
こんにちは。ご予約の確認です。<BR>
店名: {{ $shop->name }}<BR>
日時: {{ $reservation->time }}<BR>
人数: {{ $reservation->number_of_people}}<BR>
ご来店をお待ちしております。<BR></p>
</body>
</html>