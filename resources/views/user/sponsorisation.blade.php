@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Sponsorisation</h1>

        <div class="d-flex justify-content-between">

            @foreach ($sponsorisations as $sponsorisation)
                <div>
                    <p>{{$sponsorisation->name}}</p>
                    <p>{{$sponsorisation->price}}</p>
                    <p>{{$sponsorisation->time}}</p>
                </div>
            @endforeach

        </div>

        <h2>Sponsorizza il tuo appartamento</h2>

        <form method="post" id="payment-form" action="{{ route('user.sponsorisations-form') }}">
            @csrf
            <section>

                <select name="dwelling_id" id="dwellings-select">
                    <option  value='0' selected>Scegli il tuo appartamento</option>
                    @foreach ($dwellings_user as $dwelling)
                        <option value="{{$dwelling->id}}">{{$dwelling->name}}</option>
                    @endforeach
                </select>

                @error('dwelling_id')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <label for="amount">
                    <div class="input-wrapper amount-wrapper">
                        <select name="amount" id="amount">

                            <option value='0' selected>Scegli il tuo piano</option>

                            @foreach ($sponsorisations as $sponsorisation)
                                <option value="{{$sponsorisation->price}}">{{$sponsorisation->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </label>

                @error('amount')
                    <p class="error-msg text-danger"> {{ $message }} </p>
                @enderror

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit"><span>Test Transaction</span></button>
        </form>

    </div>


    {{-- braintree --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.js"></script>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

    <script>

        // ----- payment ------

        var form = document.querySelector('#payment-form');
        var client_token = {!! json_encode($token) !!};

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin'
        },
        function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });

    </script>

@endsection
