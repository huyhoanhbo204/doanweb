@extends('admin.index')

@section('title', 'Quản lý sản phẩm')
@section('link')
{{route('products.create')}}
@endsection
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

        {{-- Form tìm kiếm --}}
        <form id="searchForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Danh mục</label>
                    <select class="form-select" id="searchCategory" name="category">
                        <option value="0">Tất cả</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" id="searchStatus" name="status">
                        <option value="0">Tất cả</option>
                        <option value="active">Kích hoạt</option>
                        <option value="inactive">Ẩn</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">HOT</label>
                    <select class="form-select" id="searchHot" name="hot">
                        <option value="-1">Tất cả</option>
                        <option value="0">Không</option>
                        <option value="1">Hot</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tìm kiếm</label>
                    <input type="text" class="form-control" id="searchName" name="name" placeholder="Tìm kiếm theo tên sản phẩm...">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bảng sản phẩm -->
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr class="text-center">
                    <th style="width: 80px;">ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Tên danh mục</th>
                    <th>Giá</th>
                    <th>Giảm giá</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Hot</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th style="width: 100px;">Hành động</th>
                </tr>
            </thead>
            <tbody id="productsTableBody" class="text-center">
                {{-- Bao gồm dữ liệu ban đầu --}}
                @include('admin.product.partials.table', ['products' => $products])
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="card-footer">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end" id="paginationLinks">
                {!! $products->appends(request()->except('page'))->links('pagination::bootstrap-5') !!}
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Hàm thực hiện tìm kiếm và phân trang
        function fetchProducts(page = 1) {
            // Thu thập dữ liệu từ form
            let category = $('#searchCategory').val();
            let status = $('#searchStatus').val();
            let hot = $('#searchHot').val();
            let name = $('#searchName').val();

            // Gửi AJAX request
            $.ajax({
                url: "{{ route('products.index') }}",
                method: "GET",
                data: {
                    category: category,
                    status: status,
                    hot: hot,
                    name: name,
                    page: page
                },
                success: function(response) {
                    // Cập nhật dữ liệu bảng và phân trang
                    $('#productsTableBody').html(response.html);
                    $('#paginationLinks').html(response.pagination);
                },
                error: function(xhr) {
                    console.error('Có lỗi xảy ra:', xhr.responseText);
                }
            });
        }

        // Sự kiện thay đổi hoặc nhập liệu trên form tìm kiếm
        $('#searchCategory, #searchStatus, #searchHot, #searchName').on('change keyup', function() {
            fetchProducts(); // Gọi tìm kiếm
        });

        // Sự kiện click vào liên kết phân trang
        $(document).on('click', '#paginationLinks a', function(e) {
            e.preventDefault();

            // Lấy số trang từ link phân trang
            let page = $(this).attr('href').split('page=')[1];
            fetchProducts(page); // Gọi lại tìm kiếm với trang mới
        });
    });
</script>
@endsection