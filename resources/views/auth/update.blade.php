@extends('client.index')
@section('content')
<section class="profile-update">
    <div class="container">
        <h3 class="login-title">Update Profile</h3>

        <!-- Hiển thị thông báo lỗi hoặc thông báo status -->
        @if(session('status'))
        <div class="alert alert-success">
            <p style="color:red">{{ session('status') }}</p>
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

        <form action="{{ route('profile.update') }}" class="profile-form" method="post">
            @csrf
            <div class="information-wrapper">
                <p class="login-subtitle">Email</p>
                <input type="email" class="input-field" placeholder="Email" name="email" value="{{ old('email', auth()->user()->email) }}" readonly>
            </div>
            <div class="information-wrapper" style="margin-top:20px">
                <p class="login-subtitle">Fullname</p>
                <input type="text" class="input-field" placeholder="Fullname" name="fullname" value="{{ old('fullname', auth()->user()->fullname) }}">
            </div>
            <div class="information-wrapper" style="margin-top:20px">
                <p class="login-subtitle">Phone</p>
                <input type="phone" class="input-field" placeholder="Phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
            </div>
            <div class="information-wrapper" style="margin-top:20px">
                <p class="login-subtitle">Birthday</p>
                <input type="date" class="input-field" placeholder="Birthday" name="birthday" value="{{ old('birthday', \Carbon\Carbon::parse(auth()->user()->birthday)->format('Y-m-d')) }}">
            </div>
            <div class="information-wrapper" style="margin-top:20px">
                <p class="login-subtitle">Address</p>
                <input type="text" class="input-field" placeholder="Address" name="address" value="{{ old('address', auth()->user()->address) }}">
            </div>

            <button class="btn btn-fill" style="margin-top:20px">Update Profile</button>
        </form>
    </div>
</section>
@endsection