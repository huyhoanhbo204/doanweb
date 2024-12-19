@extends('admin.index')

@section('link')
{{ route('categories.create') }}
@endsection

@section('title_new', 'Thêm mới danh mục')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Thêm danh mục mới</h5>

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

        {{-- Form thêm danh mục --}}
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                {{-- Nhập tên danh mục --}}
                <div class="col-md-6">
                    <label class="form-label">Tên danh mục</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Nhập tên danh mục"
                        value="{{ old('name') }}"
                        required>
                </div>

                {{-- Chọn trạng thái --}}
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="active" required>
                        <option value="active" {{ old('active', 'active') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('active', 'inactive') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                {{-- Upload hình ảnh --}}
                <div class="col-md-12">
                    <label class="form-label">Hình ảnh</label>
                    <input
                        type="file"
                        class="form-control"
                        name="image"
                        accept="image/*">
                </div>
            </div>

            {{-- Nút hành động --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
@endsection