@extends('admin.index')

@section('title', 'Quản lý sản phẩm')
@section('title_new', 'Cập nhật sản phẩm')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Cập nhật sản phẩm</h5>
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

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Danh mục</label>
                    <select class="form-select" name="category_id" required>
                        <option value="">Chọn danh mục</option>
                        <!-- Populate categories here -->
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" required>
                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sản phẩm HOT?</label>
                    <select class="form-select" name="hot">
                        <option value="1" {{ old('hot', $product->hot) == 1 ? 'selected' : '' }}>Có</option>
                        <option value="0" {{ old('hot', $product->hot) == 0 ? 'selected' : '' }}>Không</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Giảm giá sản phẩm</label>
                    <input type="number" class="form-control" name="discount" value="{{ old('discount', $product->discount) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="image">
                    @if ($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" width="100px">
                    @endif
                </div>
                <div class="col-md-6"></div>

                <div class="col-md-6">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea class="form-control" name="description" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection