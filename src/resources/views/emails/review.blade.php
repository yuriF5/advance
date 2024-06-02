<title>お知らせ</title>
<p>{{ $user->name }}さん<BR>
この度は、{{ $shop->name }}へご来店いただき、ありがとうございました。<BR>
つきましては、こちらのリンクにアクセスいただき、アンケートにご協力ください。<BR>
<a href="{{ url('/review/'.$reservation->id) }}">回答ページへ</a><BR>
またのご来店をお待ちしております。<BR></p>
