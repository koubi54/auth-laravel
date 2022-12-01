<div class="flex items-center justify-end mt-4">
    <a class="ml-1 btn btn-primary" href="{{ url('auth/facebook') }}" style="margin-top: 0px !important;background: blue;color: #ffffff;padding: 5px;border-radius:7px;" id="btn-fblogin">
        <i class="fa fa-facebook-square" aria-hidden="true"></i> Login with Facebook
    </a>
</div>
<div class="flex items-center justify-end mt-4">
    <a class="ml-1 btn btn-primary" href="{{ url('auth/google') }}" style="background: red;color: #ffffff;padding: 5px;border-radius:7px;" id="btn-fblogin">
        <i class="fa fa-facebook-square" aria-hidden="true"></i> Login with Google
    </a>
</div>
<div class="flex items-center justify-end mt-4">
    <a class="ml-1 btn btn-primary" href="{{ url('auth/discore') }}" style="background: black;color: #ffffff;padding: 5px;border-radius:7px;" id="btn-fblogin">
        <i class="fa fa-facebook-square" aria-hidden="true"></i> Login with Discore
    </a>
</div>
<div class="container mt-5 text-center">
        <h2>Laravel 7 PayPal Integration Example</h2>
        <a href="{{ route('make.payment') }}" class="btn btn-primary mt-3">Pay $224 via Paypal</a>
    </div>