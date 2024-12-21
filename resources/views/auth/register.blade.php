@extends('client.index')
@section('content')
<section class="login">
    <div class="container">
        <h3 class="login-title">SIGN UP</h3>

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

        <form action="{{ route('register.submit') }}" class="login-form" method="post">
            @csrf
            <div class="information-wrapper">
                <p class="login-subtitle">Email</p>
                <input type="text" class="input-field" placeholder="Email" name="email" value="{{ old('email') }}">
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Fullname</p>
                <input type="text" class="input-field" placeholder="Fullname" name="fullname" value="{{ old('fullname') }}">
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Password</p>
                <input type="password" class="input-field" placeholder="Password" name="password" value="{{ old('password') }}">
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Confirm Password</p>
                <input type="password" class="input-field" placeholder="Confirm Password" name="password_confirmation">
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Phone</p>
                <input type="number" class="input-field" placeholder="Phone" name="phone" value="{{ old('phone') }}">
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Address</p>
                <input type="text" class="input-field" placeholder="Address" name="address" value="{{ old('address') }}">
            </div>

            <button class="btn btn-fill">SIGN UP</button>
        </form>


        <p class="login-side-subtitle">You already have an account? <a class="section-subtitle" href="{{ route('login') }}">Sign in here</a></p>
    </div>
</section>
@endsection