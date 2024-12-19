@extends('admin.index')

@section('title', 'Quản lý sản phẩm')
@section('title_new', 'Thêm mới sản phẩm')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Thêm mới sản phẩm</h5>
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
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Danh mục</label>
                    <select class="form-select" name="category_id" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sản phẩm HOT?</label>
                    <select class="form-select" name="hot">
                        <option value="1" {{ old('hot') == 1 ? 'selected' : '' }}>Có</option>
                        <option value="0" {{ old('hot') == 0 ? 'selected' : '' }}>Không</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection