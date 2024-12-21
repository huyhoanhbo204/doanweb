@extends('client.index')
@section('content')
<section class="login">
    <div class="container">
        <h3 class="login-title">Reset Password</h3>



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

        <form action="{{ route('password.update') }}" class="login-form" method="post">
            @csrf
            <input type="hidden" name="token" value="{{$token}}">
            <div class="information-wrapper">
                <p class="login-subtitle">Email</p>
                <input type="text" class="input-field" placeholder="Placehoder email ...." name="email" value="{{ $email }}" readonly>
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Password</p>
                <input type="password" class="input-field" placeholder="Placehoder password ...." name="password">
            </div>
            <div class="information-wrapper">
                <p class="login-subtitle">Password</p>
                <input type="password" class="input-field" placeholder="Placehoder comfirmation password ...." name="password_confirmation">
            </div>
            <button class="btn btn-fill">RESET PASSWORD</button>
        </form>


    </div>
</section>

@endsection