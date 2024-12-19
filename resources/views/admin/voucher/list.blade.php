@extends('admin.index')

@section('link')
{{ route('vouchers.create') }}
@endsection

@section('title', 'Quản lý Voucher')

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
        <form action="{{ route('vouchers.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" id="searchStatus">
                        <option value="">Tất cả</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Mã voucher</label>
                    <input type="text" class="form-control" name="code" id="searchCode" value="{{ request('code') }}" placeholder="Nhập mã voucher...">
                </div>

                <div class="col-md-3" style="margin-top:47px;">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Voucher Items Table -->
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="vouchersTable">
            <thead>
                <tr class="text-center">
                    <th style="width: 80px;">ID</th>
                    <th>Mã Voucher</th>
                    <th>Mô Tả</th>
                    <th>Giảm Giá</th>
                    <th>Loại Giảm Giá</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Trạng Thái</th>
                    <th style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->id }}</td>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->description }}</td>
                    <td>
                        @if($voucher->type == 'percent')
                        {{ number_format($voucher->discountValue, 2, ',', '.') }}%
                        @else
                        {{ number_format($voucher->discountValue, 0, ',', '.') }} VND
                        @endif
                    </td>


                    <td>
                        @if($voucher->type == 'fixed')
                        Cố định
                        @elseif($voucher->type == 'percent')
                        Phần trăm
                        @endif
                    </td>

                    <td>{{ \Carbon\Carbon::parse($voucher->validFrom)->format('d/m/Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($voucher->validTo)->format('d/m/Y H:i') }}</td>
                    <td>
                        <!-- Trạng thái (Status) -->
                        @if($voucher->status == 'active')
                        <span class="badge bg-success">Kích hoạt</span>
                        @elseif($voucher->status == 'inactive')
                        <span class="badge bg-danger">Ẩn</span>
                        @else
                        <span class="badge bg-secondary">Chưa xác định</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <!-- Nút sửa -->
                            <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-light">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Nút xóa -->
                            <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this voucher?');">
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