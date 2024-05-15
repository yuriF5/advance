@extends('layouts.appad')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_list.css') }}">
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <!--お知らせメール作成-->
        <div>
            <h1 class="text-lg">お知らせメール作成</h1>
            <a class="ml-3 block text-center text-blue-800 bg-white border-solid border border-blue-800 hover:bg-gray-200 rounded w-20" href="">作成</a>
        </div>
        <!--管理者登録-->
        <div class="mt-3">
            <h1 class="text-lg">管理者登録・変更</h1>
            <form method="POST" action="" class="p-3">
                @csrf
                <div>
                    {{ session('message') }}
                </div>
                <div class="mb-1">
                    <label for="name" class="inline-block w-12">名前</label>
                    <input type="text" name="name" value="{{ old('name') }}">
                    <div class="text-red-600">
                        @error('name')
                            ※{{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-1">
                    <label for="email" class="inline-block w-12">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}">
                    <div class="text-red-600">
                        @error('email')
                            ※{{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-1">
                    <label for="role" class="inline-block w-12">役割</label>
                    <select name="role">
                        
                    </select>
                </div>
                <div class="mb-1">
                    <label for="shop" class="inline-block w-12">店舗</label>
                    <select name="shop">
                        
                    
                </div>
                <div class="ml-8">
                    <button class="text-blue-800 bg-white border-solid border border-blue-800 hover:bg-gray-200 rounded w-20" type="submit">
                        登録・変更
                    </button>
                </div>
            </form>
        </div>
        <!--管理者一覧-->
        <div class="mt-3">
            <h1 class="text-lg">管理者一覧</h1>
            <table>
                <tr class="border-t border-black [&>th]:text-left [&>th]:p-4">
                    <th>名前</th>
                    <th>Email</th>
                    <th>役割</th>
                    <th>店舗</th>
                </tr>
               
                    </td>
                    <td>
                        <form method="POST" action="{{ url('admin/delete') }}">
                            @csrf
                            <input type="hidden" name="">
                            <button class="text-blue-800 bg-white border-solid border border-blue-800 hover:bg-gray-200 rounded w-20" type="submit">
                                削除
                            </button>
                        </form>
                    </td>
                </tr>

                
                
            </table>
        </div>
    </div>
@endsection