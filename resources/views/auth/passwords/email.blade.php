@extends('client.index')
@section('content')
<section class="login">
    <div class="container">
        <h3 class="login-title">FORGET PASSWORD</h3>

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

        <form action="{{ route('password.email') }}" class="login-form" method="post">
            @csrf
            <div class="information-wrapper">
                <p class="login-subtitle">Email</p>
                <input type="text" class="input-field" placeholder="Placehoder email ...." name="email">
            </div>
            <button class="btn btn-fill">RESET</button>
        </form>

        <p class="login-side-subtitle">Do you already have a password? <a class="section-subtitle" href="{{ route('login') }}">Sign in here</a></p>
    </div>
</section>

@endsection



