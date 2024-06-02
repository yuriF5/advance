@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="container">
    @if (session('flash_alert'))
        <div class="alert alert-danger">{{ session('flash_alert') }}</div>
    @elseif(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="p-5">
        <div class="col-6 card">
            <div class="card-header">Stripe決済</div>
            <div class="card-body">
                <form id="card-form" action="{{ route('payment.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="card_number">カード番号</label>
                        <div id="card-number" class="form-control"></div>
                    </div>
                    <div class="error__item">
                        @error('card_number')
                        <span class="error__message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="card_expiry">有効期限</label>
                        <div id="card-expiry" class="form-control"></div>
                    </div>
                    <div class="error__item">
                        @error('card_expiry')
                        <span class="error__message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="card-cvc">セキュリティコード</label>
                        <div id="card-cvc" class="form-control"></div>
                    </div>
                    <div class="error__item">
                        @error('card_cvc')
                        <span class="error__message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div id="card-errors" class="text-danger"></div>

                    <div class="text-right">
                        <button class="mt-3 btn btn-primary">支払い</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="https://buy.stripe.com/test_dR60404su2F0bg4aEF" class="shop__button-detail">イタリアン</a>
    
    <a href="https://buy.stripe.com/test_6oE1840cea7s3NC28a" class="shop__button-detail">ラーメン</a>
</div>



    <script src="https://js.stripe.com/v3/"></script>
    <script>
        /* 基本設定*/
        const stripe_public_key = "{{ config('stripe.stripe_public_key') }}"
        const stripe = Stripe(stripe_public_key);
        const elements = stripe.elements();

        var cardNumber = elements.create('cardNumber');
        cardNumber.mount('#card-number');
        cardNumber.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var cardExpiry = elements.create('cardExpiry');
        cardExpiry.mount('#card-expiry');
        cardExpiry.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var cardCvc = elements.create('cardCvc');
        cardCvc.mount('#card-cvc');
        cardCvc.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('card-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var errorElement = document.getElementById('card-errors');
            if (event.error) {
                errorElement.textContent = event.error.message;
            } else {
                errorElement.textContent = '';
            }

            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('card-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
    @endsection