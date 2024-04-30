@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/csv_index.css') }}">
@endsection

@section('content')
<div class="upload">
    <p>DBに追加したいCSVデータを選択してください。</p>
    <form action="/csv/upload/" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csvdata" />
        <button>送信</button>
    </form>
</div>

<div class="contents">
    <p>{{$cnt}}件登録しました。</p>
    <table>
        <tr>
        <th>ID</th>
        <th>店舗名</th>
        <th>地域</th>
        <th>ジャンル</th>
        <th>画像URL</th>
        <th>created_at</th>
        <th>updated_at</th>
        </tr>

        <!-- DBから取得したデータを一覧表示する -->
        @foreach ($data as $val)
        <tr>
        <td>{{ $val->id }}</td>
        <td>{{ $val->name }}</td>
        <td>{{ $val->area }}</td>
        <td>{{ $val->genre }}</td>
        <td>{{ $val->image_url }}</td>
        <td>{{ $val->created_at }}</td>
        <td>{{ $val->updated_at }}</td>
        </tr>
    @endforeach
    </table>
</div>
@endsection
