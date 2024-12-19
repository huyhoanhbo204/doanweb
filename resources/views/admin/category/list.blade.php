@extends('admin.index')

@section('link')
{{ route('categories.create') }}
@endsection
@section('title', 'Quản lý danh mục')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        {{-- Hiển thị thông báo thành công --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        {{-- Hiển thị thông báo lỗi --}}
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="{{ route('categories.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="active" id="searchActive">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request('active') == '1' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="0" {{ request('active') == '0' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" class="form-control" name="name" id="searchName" value="{{ request('name') }}" placeholder="Nhập tên danh mục...">
                </div>

                <div class="col-md-3" style="margin-top:47px;">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Menu Items Table -->
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="categoriesTable">
            <thead>
                <tr class="text-center">
                    <th style="width: 80px;">ID</th>
                    <th>Tên danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="img">
                            <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" width="100">
                        </div>
                    </td>
                    <td>
                        <!-- Trạng thái (Status) -->
                        @if($category->status == 'active')
                        <span class="badge bg-success">Kích hoạt</span>
                        @elseif($category->status == 'inactive')
                        <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <!-- Nút sửa -->
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-light">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Nút xóa -->
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection