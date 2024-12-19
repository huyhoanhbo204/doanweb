@extends('admin.index')

@section('title', 'Quản lý người dùng')
@section('title_new', 'Cập Nhật Người Dùng')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Cập Nhật Người Dùng</h5>
        <!-- Hiển thị lỗi nếu có -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Họ tên</label>
                    <input type="text" class="form-control" name="fullname" value="{{ old('fullname', $user->fullname) }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" name="birthday" value="{{ old('birthday', \Carbon\Carbon::parse($user->birthday)->format('Y-m-d')) }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Vai trò</label>
                    <select class="form-select" name="role" required>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Người dùng</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                        <option value="sales" {{ old('role', $user->role) == 'sales' ? 'selected' : '' }}>Cộng tác viên</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" required>
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Bị cấm</option>
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection