@extends('admin.index')

@section('title', 'Quản lý người dùng')
@section('title_new', 'Thêm Người Dùng')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Thêm Người Dùng Mới</h5>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Họ tên</label>
                    <input type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Vai trò</label>
                    <select class="form-select" name="role" required>
                        <option value="user">Người dùng</option>
                        <option value="admin">Quản trị viên</option>
                        <option value="sales">Cộng tác viên</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" required>
                        <option value="active">Kích hoạt</option>
                        <option value="inactive">Bị cấm</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection