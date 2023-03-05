@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="checkout-progress-sidebar">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Total Pembayaran</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        <li>
                                            {{-- jika memasukan kupon di halaman chekcout --}}
                                            @if(Session::has('coupon'))
                                            {{-- tampilkan sintak berikut --}}
                                            <strong>SubTotal: </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                            <hr>

                                            <strong>Kupon: </strong>
                                            {{ session()->get('coupon')['coupon_name'] }}
                                            ({{ session()->get('coupon')['coupon_discount'] }} % )
                                            <hr>

                                            <strong>Diskon Kupon: </strong>
                                            Rp{{ number_format(session()->get('coupon')['discount_amount'], 0, '', '.') }}
                                            <hr>

                                            <strong>Total Bayar: </strong>
                                            Rp{{ number_format(session()->get('coupon')['total_amount'], 0, '', '.') }}
                                            <hr>

                                            @else
                                            {{-- jika tidak memasdukan diskon kupon maka --}}
                                            <strong>SubTotal: </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                            <hr>

                                            <strong>Total Bayar: </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                            <hr>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="checkout-progress-sidebar">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Metode Pembayaran</h4>
                                </div>

                                <form action="{{ route('pay.stripe') }}" method="post" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <label for="card-element">
                                            <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                            <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                            <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                            <input type="hidden" name="poscode" value="{{ $data['post_code'] }}">
                                            <input type="hidden" name="province_id" value="{{ $data['province_id'] }}">
                                            <input type="hidden" name="city_id" value="{{ $data['city_id'] }}">
                                            <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                            <input type="hidden" name="addres" value="{{ $data['addres'] }}">
                                        </label>

                                        <div id="card-element">
                                            {{--  --}}
                                        </div>
                                        {{--  --}}
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary">Buat Pesanan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // create a stripe client
    var stripe = Stripe('pk_test_51M5mhBLdxOR71fsNSIaYpjQUULlmNtWXKDAsPBnvoqGDNjXsmjs31d8zXtZrNhsDLDWFc7F8uvbjOELSLGKT0ovs00vDhi36Ol');

    // create a istance elemen
    var elements = stripe.elements();

    // custom styling
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px', '::placeholoder': {
                color: '#aab7c4'
            } 
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var card = elements.create('card', {
        style: style
    });

    // add instance
    card.mount('#card-element');
    // heandle
    card.on('change', function(event){
        var displayError = document.getElementById('card-errors');
        if(event.error){
            displayError.textContent = '';
        }
    });

    // hheandle
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event){
        event.preventDefault();
        stripe.createToken(card).then(function (result){
            if(result.error){
                // inform user
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            }else{
                // striped
                stripeTokenHandler(result.token);
            }
        });
    });

    // submit the form
    function stripeTokenHandler(token){
        // insert the token 
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // submit the form
        form.submit();
    }
</script>

@endsection