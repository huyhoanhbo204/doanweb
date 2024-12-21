@extends('admin.index')

@section('link')
{{ route('vouchers.create') }}
@endsection

@section('title_new', 'Thêm mới Voucher')

@section('title', 'Quản lý Voucher')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Thêm voucher mới</h5>

        {{-- Hiển thị danh sách lỗi xác thực --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Hiển thị lỗi từ session --}}
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        {{-- Form thêm voucher --}}
        <form action="{{ route('vouchers.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                {{-- Nhập mã voucher --}}
                <div class="col-md-6">
                    <label class="form-label">Mã voucher</label>
                    <input
                        type="text"
                        class="form-control"
                        name="code"
                        placeholder="Nhập mã voucher"
                        value="{{ old('code') }}"
                        required>
                </div>

                {{-- Mô tả voucher --}}
                <div class="col-md-6">
                    <label class="form-label">Mô tả</label>
                    <input
                        type="text"
                        class="form-control"
                        name="description"
                        placeholder="Nhập mô tả"
                        value="{{ old('description') }}">
                </div>

                {{-- Giảm giá --}}
                <div class="col-md-6">
                    <label class="form-label">Giảm giá</label>
                    <input
                        type="number"
                        class="form-control"
                        name="discountValue"
                        step="0.01"
                        value="{{ old('discountValue') }}"
                        required>
                </div>
                <input type="hidden" name="type" value="{{ old('type') == 'percent' ? 'selected' : '' }}">


                {{-- Ngày bắt đầu --}}
                <div class="col-md-6">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        name="validFrom"
                        value="{{ old('validFrom') }}"
                        required>
                </div>

                {{-- Ngày kết thúc --}}
                <div class="col-md-6">
                    <label class="form-label">Ngày kết thúc</label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        name="validTo"
                        value="{{ old('validTo') }}"
                        required>
                </div>

                {{-- Trạng thái --}}
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
            </div>
            {{-- Nút hành động --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Thêm voucher</button>
                <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
@endsection