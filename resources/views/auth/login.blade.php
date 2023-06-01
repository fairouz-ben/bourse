<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>  {{__('translation.title')}}   </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="{{asset('css/css.css')}}" rel="stylesheet">
        <link href="{{asset('css/A.style.css')}}" rel="stylesheet">
        <link rel="stylesheet" href=" {{asset('css/bootstrap.rtl.min.css')}}">
        @vite('resources/js/app.js')

        <script nonce="57549eae-bfa5-41ca-86e0-4274e0570e50">

        </script>
    </head>
<body>
<section class="ftco-section">
  
<div class="container">
<div class="row justify-content-center">
    <img class="rounded " src="{{asset('ban.png')}}" alt="" width="100%" >
<div class="col-md-6 text-center mb-5">
<h2 class="heading-section"></h2>

</div>
</div>
<div class="row justify-content-center">
<div class="col-md-12 col-lg-10">
<div class="wrap d-md-flex">
<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
<div class="text w-100">

<h2>منصة الترشح لبرنامج التكوين وتحسين المستوى بالخارج</h2>
{{-- <a href="#" class="btn btn-white btn-outline-white"></a> --}}
</div>
</div>
<div class="login-wrap p-4 p-lg-5">
<div class="d-flex" dir="rtl">
<div class="w-100">
<h3 class="mb-4">تسجيل الدخول</h3>
</div>
<div class="w-100">
<p class="social-media d-flex justify-content-end">
</p>
</div>
</div>
<form method="POST" action="{{route('login')}}" style="text-align:right">
    @csrf
   

<div class="form-group mb-3" >
<label class="label" for="email"> {{ __('translation.email') }}</label>
<input type="email" class="form-control @error('email') is-invalid @enderror"  name="email"  id="email" placeholder="mail@univ-alger.dz" value="{{ old('email') }}" required autocomplete="email" autofocus>
<p id="emailerror" style="color: red;"></p>
@error('email')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="form-group mb-3">
<label class="label" for="password">{{ __('translation.password') }}</label>
<input type="password"  name="password" placeholder="Password" required
class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">
@error('password')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" id="btlogin" class="btn btn-primary" disabled>
            {{ __('translation.btn_login') }}
        </button>

        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('validation.ForgotPassword') }}
            </a>
        @endif
    </div>
</div>
<br>{{--
<div class="form-group">
<button type="submit" class="form-control btn btn-primary submit px-3">S'identifier - تسجيل الدخول</button>
</div>--}}
</form>
<div class="form-group">
    <a href="{{ route('register') }}"  style="color: white">
<button type="link" class="form-control btn btn-primary submit px-3">S'enregistrer - إنشاء حساب </button></a>
</div>
<div class="form-group d-md-flex">

<div class="w-50 text-md-right">

</div>
</div>

</div>
</div>
</div>
</div>
</div>
</section>
<script type="text/javascript">

email.onchange = function() {
    let univreg=/\w+(.)?\w+(@univ-alger.dz)/ig;
    if(email.value.match(univreg)){ 
        emailerror.innerHTML =' '
        document.getElementById('btlogin').disabled = false;
       
    }
    else { 
    emailerror.innerHTML ='بريد إلكتروني خاطئ'
    }
};
</script>
</body></html>