@extends('admin.index')

@section('link')
{{ route('banners.create') }}
@endsection

@section('title_new', 'Thêm mới banner')

@section('title', 'Quản lý banner')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Thêm banner mới</h5>

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

        {{-- Form thêm banner --}}
        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                {{-- Nhập tiêu đề banner --}}
                <div class="col-md-6">
                    <label class="form-label">Tiêu đề banner</label>
                    <input
                        type="text"
                        class="form-control"
                        name="banner_title"
                        placeholder="Nhập tiêu đề banner"
                        value="{{ old('banner_title') }}"
                        required>
                </div>

                {{-- Nhập phụ đề banner --}}
                <div class="col-md-6">
                    <label class="form-label">Phụ đề banner</label>
                    <input
                        type="text"
                        class="form-control"
                        name="banner_subtitle"
                        placeholder="Nhập phụ đề banner"
                        value="{{ old('banner_subtitle') }}"
                        required>
                </div>

                {{-- Nhập nội dung banner --}}
                <div class="col-md-12">
                    <label class="form-label">Nội dung banner</label>
                    <textarea
                        class="form-control"
                        name="banner_text"
                        placeholder="Nhập nội dung banner"
                        required>{{ old('banner_text') }}</textarea>
                </div>

                {{-- Chọn trạng thái --}}
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="active" required>
                        <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                {{-- Upload hình ảnh --}}
                <div class="col-md-12">
                    <label class="form-label">Hình ảnh</label>
                    <input
                        type="file"
                        class="form-control"
                        name="img"
                        accept="image/*">
                </div>
            </div>

            {{-- Nút hành động --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Thêm banner</button>
                <a href="{{ route('banners.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
@endsection