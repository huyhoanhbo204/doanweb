@extends('admin.index')

@section('link')
{{ route('banners.create') }}
@endsection

@section('title', 'Quản lý Banner')

@section('content')
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


</div>
<!-- Banner Items Table -->
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="bannersTable">
            <thead>
                <tr class="text-center">
                    <th style="width: 80px;">ID</th>
                    <th>Tiêu đề</th>
                    <th>Phụ đề</th>
                    <th>Nội dung</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th style="width: 100px;">Thao tác</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->banner_title }}</td>
                    <td>{{ $banner->banner_subtitle }}</td>
                    <td>{{ $banner->banner_text }}</td>
                    <td>
                        <div class="img">
                            <img src="{{ asset('storage/banners/'.$banner->img) }}" alt="{{ $banner->banner_title }}" width="100">
                        </div>
                    </td>
                    <td>
                        <!-- Trạng thái (Status) -->
                        @if($banner->active == 1)
                        <span class="badge bg-success">Kích hoạt</span>
                        @elseif($banner->active == 0)
                        <span class="badge bg-danger">Ẩn</span>
                        @else
                        <span class="badge bg-secondary">Chưa xác định</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <!-- Nút sửa -->
                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-light">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Nút xóa -->
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this banner?');">
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
    {{-- Hiển thị phân trang --}}
    <div class="card-footer">
        {{ $banners->links() }}
    </div>
</div>
@endsection