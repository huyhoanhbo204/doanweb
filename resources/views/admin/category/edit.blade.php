@extends('admin.index')

@section('title', 'Quản lý danh mục')
@section('title_new', 'Cập nhật danh mục')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Cập nhật danh mục</h5>

        {{-- Hiển thị lỗi xác thực --}}
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

        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Method spoofing for PUT -->
            <div class="row g-3">
                {{-- Tên danh mục --}}
                <div class="col-md-6">
                    <label class="form-label">Tên danh mục</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Nhập tên danh mục"
                        value="{{ old('name', $category->name) }}"
                        required>
                </div>

                {{-- Trạng thái --}}
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="active" required>
                        <option value="active" {{ old('active', $category->status) == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('active', $category->status) == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>

                </div>

                {{-- Hình ảnh --}}
                <div class="col-md-12">
                    <label class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    @if ($category->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" width="100">
                        <p class="text-muted">Hình ảnh hiện tại</p>
                    </div>
                    @endif
                </div>
            </div>
            {{-- Nút hành động --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
@endsection