@extends('client.index')
@section('content')
<section class="login">
    <div class="container">
        <h3 class="login-title">LOGIN</h3>

        <!-- Hiển thị thông báo lỗi hoặc thông báo status -->
        @if(session('status'))
        <div class="alert alert-danger">
            <p style="color: red;">{{ session('status') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login') }}" class="login-form" method="post">
            @csrf
            <div class="information-wrapper">
                <p class="login-subtitle">Email</p>
                <input type="text" class="input-field" placeholder="Placehoder email ...." name="email">
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Password</p>
                <input type="password" class="input-field" placeholder="Placehoder password ...." name="password">
            </div>
            <button class="btn btn-fill">LOGIN</button>
        </form>

        <div class="information-wrapper">
            <p class="login-side-subtitle">Or</p>
            <a href="{{ route('auth.google') }}">
                <ion-icon name="logo-google"></ion-icon>
            </a>
        </div>

        <p class="login-side-subtitle">Don't have an account? <a class="section-subtitle" href="{{ route('register') }}">Sign up</a></p>

        <div class="information-wrapper">
            <p class="login-side-subtitle"><a href="{{ route('password.request') }}" style="color:blue">Forgot your password?</a></p>
        </div>
    </div>
</section>

@endsection