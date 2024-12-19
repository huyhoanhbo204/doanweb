@extends('admin.index')

@section('link')
{{ route('vouchers.edit', $voucher->id) }}
@endsection

@section('title_new', 'Chỉnh sửa Voucher')

@section('title', 'Quản lý Voucher')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Chỉnh sửa voucher</h5>

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

        {{-- Form chỉnh sửa voucher --}}
        <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Đảm bảo phương thức HTTP là PUT --}}
            <div class="row g-3">
                {{-- Nhập mã voucher --}}
                <div class="col-md-6">
                    <label class="form-label">Mã voucher</label>
                    <input
                        type="text"
                        class="form-control"
                        name="code"
                        placeholder="Nhập mã voucher"
                        value="{{ old('code', $voucher->code) }}"
                        required>
                </div>

                {{-- Mô tả voucher --}}
                <div class="col-md-6">
                    <label class="form-label">Mô tả</label>
                    <input
                        type="text"
                        class="form-control"
                        name="description"
                        placeholder="Nhập mô tả"
                        value="{{ old('description', $voucher->description) }}">
                </div>
                {{-- Giảm giá --}}
                {{-- Giảm giá --}}
                <div class="col-md-6">
                    <label class="form-label">Giảm giá</label>
                    <input
                        type="text"
                        class="form-control"
                        name="discountValue"
                        id="discountValue"
                        value="{{ old('discountValue', number_format($voucher->discountValue, 0, '', '')) }}"
                        required>
                </div>
                {{-- Loại voucher --}}
                <div class="col-md-6">
                    <label class="form-label">Loại giảm giá</label>
                    <select class="form-select" name="type" required>
                        <option value="percent" {{ old('type', $voucher->type) == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                        <option value="fixed" {{ old('type', $voucher->type) == 'fixed' ? 'selected' : '' }}>Cố định</option>
                    </select>
                </div>

                {{-- Ngày bắt đầu --}}
                <div class="col-md-6">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        name="validFrom"
                        value="{{ old('validFrom', \Carbon\Carbon::parse($voucher->validFrom)->format('Y-m-d\TH:i')) }}"
                        required>
                </div>

                {{-- Ngày kết thúc --}}
                <div class="col-md-6">
                    <label class="form-label">Ngày kết thúc</label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        name="validTo"
                        value="{{ old('validTo', \Carbon\Carbon::parse($voucher->validTo)->format('Y-m-d\TH:i')) }}"
                        required>
                </div>

                {{-- Trạng thái --}}
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status" required>
                        <option value="active" {{ old('status', $voucher->status) == 'active' ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="inactive" {{ old('status', $voucher->status) == 'inactive' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>
            </div>
            {{-- Nút hành động --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Cập nhật voucher</button>
                <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')


@endsection