@extends('admin.index')

@section('link')
{{ route('banners.index') }} <!-- Trả về danh sách banner sau khi lưu -->
@endsection

@section('title_new', 'Chỉnh sửa banner')

@section('title', 'Quản lý banner')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Chỉnh sửa banner</h5>

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

        {{-- Form chỉnh sửa banner --}}
        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Đảm bảo là PUT request để cập nhật banner -->

            <div class="row g-3">
                {{-- Nhập tiêu đề banner --}}
                <div class="col-md-6">
                    <label class="form-label">Tiêu đề banner</label>
                    <input
                        type="text"
                        class="form-control"
                        name="banner_title"
                        placeholder="Nhập tiêu đề banner"
                        value="{{ old('banner_title', $banner->banner_title) }}" required>
                </div>

                {{-- Nhập phụ đề banner --}}
                <div class="col-md-6">
                    <label class="form-label">Phụ đề banner</label>
                    <input
                        type="text"
                        class="form-control"
                        name="banner_subtitle"
                        placeholder="Nhập phụ đề banner"
                        value="{{ old('banner_subtitle', $banner->banner_subtitle) }}"
                        required>
                </div>

                {{-- Nhập nội dung banner --}}
                <div class="col-md-12">
                    <label class="form-label">Nội dung banner</label>
                    <textarea
                        class="form-control"
                        name="banner_text"
                        placeholder="Nhập nội dung banner"
                        required>{{ old('banner_text', $banner->banner_text) }}</textarea> <!-- Lấy giá trị hiện tại của banner -->
                </div>

                {{-- Chọn trạng thái --}}
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="active" required>
                        <option value="1" {{ old('active', $banner->active) == '1' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="0" {{ old('active', $banner->active) == '0' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                {{-- Hiển thị ảnh hiện tại --}}
                @if ($banner->img)
                <div class="col-md-12">
                    <label class="form-label">Hình ảnh hiện tại</label><br>
                    <img src="{{ asset('storage/banners/'.$banner->img) }}" alt="Banner Image" width="150"> <!-- Hiển thị ảnh hiện tại -->
                    <p><small><em>(Nếu bạn muốn thay đổi hình ảnh, vui lòng chọn ảnh mới.)</em></small></p>
                </div>
                @endif

                {{-- Upload hình ảnh mới --}}
                <div class="col-md-12">
                    <label class="form-label">Hình ảnh mới</label>
                    <input
                        type="file"
                        class="form-control"
                        name="img"
                        accept="image/*"
                        id="image-upload"
                        onchange="previewImage(event)"> <!-- Gọi hàm previewImage khi chọn ảnh -->
                </div>

                {{-- Thẻ div để hiển thị ảnh mới nếu người dùng chọn ảnh --}}
                <div id="image-preview-container" class="col-md-12" style="display: none;">
                    <label class="form-label">Hình ảnh bạn đã chọn</label><br>
                    <img src="" alt="Preview Image" id="image-preview" width="150"> <!-- Ảnh sẽ hiển thị ở đây -->
                </div>
            </div>

            {{-- Nút hành động --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Cập nhật banner</button>
                <a href="{{ route('banners.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    // Hàm preview hình ảnh
    function previewImage(event) {
        var reader = new FileReader();
        var previewContainer = document.getElementById('image-preview-container');
        var previewImage = document.getElementById('image-preview');

        // Kiểm tra nếu có ảnh được chọn
        if (event.target.files && event.target.files[0]) {
            var file = event.target.files[0];

            // Đọc ảnh bằng FileReader
            reader.onload = function(e) {
                previewImage.src = e.target.result; // Cập nhật ảnh preview
                previewContainer.style.display = 'block'; // Hiển thị container preview ảnh
            }

            reader.readAsDataURL(file); // Đọc file ảnh
        }
    }
</script>
@endsection