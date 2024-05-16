@if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        新しいメール確認リンクが送信されました！
    </div>
@endif

<div>
    続行する前に、メールに記載された確認リンクをクリックしてください。
    もしメールを受け取っていない場合は、<form method="POST" action="{{ route('verification.send') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">こちらをクリックして再送信してください</button>。
    </form>
</div>

