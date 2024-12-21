@extends('client.index')
@section('content')
<section class="password-update">
    <div class="container">
        <h3 class="login-title">Change Password</h3>

        <!-- Hiển thị thông báo lỗi hoặc thông báo status -->
        @if(session('status'))
        <div class="alert alert-success">
            <p style="color:green">{{ session('status') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('password.update') }}" class="password-form" method="post">
            @csrf

            <div class="information-wrapper">
                <p class="login-subtitle">Email</p>
                <input type="email" class="input-field" placeholder="Email" name="email" value="{{ old('email', auth()->user()->email) }}" readonly>
            </div>
            <div class="information-wrapper" style="margin-top:20px">
                <p class="login-subtitle">Current Password</p>
                <input type="password" class="input-field" placeholder="Current Password" name="current_password">
            </div>
            <div class="information-wrapper" style="margin-top:20px">
                <p class="login-subtitle">New Password</p>
                <input type="password" class="input-field" placeholder="New Password" name="password">
            </div>
            <div class="information-wrapper" style="margin-top:20px">
                <p class="login-subtitle">Confirm New Password</p>
                <input type="password" class="input-field" placeholder="Confirm New Password" name="password_confirmation">
            </div>

            <button class="btn btn-fill" style="margin-top:20px">Change Password</button>
        </form>
    </div>
</section>
@endsection