    @extends('admin.index')

    @section('title', 'Quản lý người dùng')
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
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Vai trò</label>
                    <select class="form-select" id="searchRole">
                        <option value="all">Tất cả</option>
                        <option value="user">Người dùng</option>
                        <option value="admin">Quản trị viên</option>
                        <option value="sales">Cộng tác viên</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" id="searchStatus">
                        <option value="all">Tất cả</option>
                        <option value="active">Kích hoạt</option>
                        <option value="inactive">Bị cấm</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" class="form-control" id="searchEmail" placeholder="Tìm kiếm theo email...">
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Items Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="usersTable">
                <thead>
                    <tr class="text-center">
                        <th style="width: 80px;">ID</th>
                        <th>Email</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="usersTableBody">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') ?? '' }}</td>
                        <td>
                            @if($user->role == 'admin')
                            <span class="badge bg-warning text-dark">Quản trị viên</span>
                            @elseif($user->role == 'sales')
                            <span class="badge bg-info text-dark">Cộng tác viên</span>
                            @else
                            <span class="badge bg-primary">Người dùng</span>
                            @endif
                        </td>
                        <td>
                            @if($user->status == 'active')
                            <span class="badge bg-success">Kích hoạt</span>
                            @elseif($user->status == 'inactive')
                            <span class="badge bg-danger">Bị cấm</span>
                            @else
                            <span class="badge bg-secondary">Chưa xác định</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($user->dateCreated)->format('d/m/Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->dateUpdated)->format('d/m/Y H:i') }}</td>
                        <td>

                            <div class="btn-group">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> -->
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end" id="paginationLinks">
                    {!! $users->appends(request()->except('page'))->links('pagination::bootstrap-5') !!}

                </ul>
            </nav>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
        $(document).ready(function() {

            $('#searchEmail, #searchRole, #searchStatus').on('change', function() {
                var email = $('#searchEmail').val();
                var role = $('#searchRole').val();
                var status = $('#searchStatus').val();
                loadData(email, role, status, 1);
            });

            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                var page = new URL($(this).attr('href')).searchParams.get('page');
                var email = $('#searchEmail').val();
                var role = $('#searchRole').val();
                var status = $('#searchStatus').val();
                loadData(email, role, status, page);
            });


            function loadData(email, role, status, page) {

                var url = "{{ route('user.index', ['role' => '__role__', 'active' => '__active__', 'email' => '__email__', 'page' => '__page__']) }}";
                url = url.replace('__role__', role)
                    .replace('__active__', status)
                    .replace('__email__', email)
                    .replace('__page__', page);


                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Response:', response);
                        var usersHtml = '';
                        response.data.forEach(function(user) {
                            var url_edit = "http://foodorder.com/admin/users/" + user.id + "/edit";
                            console.log(user);
                            var birthday = user.birthday ? new Date(user.birthday).toLocaleDateString() : '';
                            var dateCreated = new Date(user.dateCreated).toLocaleString();
                            var dateUpdated = new Date(user.dateUpdated).toLocaleString();

                            var roleBadge = '';
                            if (user.role === 'admin') {
                                roleBadge = '<span class="badge bg-warning text-dark">Quản trị viên</span>';
                            } else if (user.role === 'sales') {
                                roleBadge = '<span class="badge bg-info text-dark">Cộng tác viên</span>';
                            } else {
                                roleBadge = '<span class="badge bg-primary">Người dùng</span>';
                            }

                            var statusBadge = '';
                            if (user.status === 'active') {
                                statusBadge = '<span class="badge bg-success">Kích hoạt</span>';
                            } else if (user.status === 'inactive') {
                                statusBadge = '<span class="badge bg-danger">Bị cấm</span>';
                            } else {
                                statusBadge = '<span class="badge bg-secondary">Chưa xác định</span>';
                            }

                            usersHtml += '<tr>';
                            usersHtml += `<td>${user.id}</td>`;
                            usersHtml += `<td>${user.email}</td>`;
                            usersHtml += `<td>${user.fullname}</td>`;
                            usersHtml += `<td>${user.address}</td>`;
                            usersHtml += `<td>${user.phone}</td>`;
                            usersHtml += `<td>${birthday}</td>`;
                            usersHtml += `<td>${roleBadge}</td>`;
                            usersHtml += `<td>${statusBadge}</td>`;
                            usersHtml += `<td>${dateCreated}</td>`;
                            usersHtml += `<td>${dateUpdated}</td>`;
                            usersHtml += '<td>';
                            usersHtml += '<div class="btn-group">';
                            usersHtml += '<a href="http://foodorder.com/admin/users/' + user.id + '/edit" class="btn btn-sm btn-light">';
                            usersHtml += '<i class="fas fa-edit"></i></a>';
                            usersHtml += '</div>';
                            usersHtml += '</td>';
                            usersHtml += '</tr>';

                        });
                        $('#usersTableBody').html(usersHtml);


                        var paginationHtml = '';


                        if (response.prev_page_url) {
                            paginationHtml += '<li class="page-item"><a class="page-link" href="' + response.prev_page_url + '" rel="prev">‹</a></li>';
                        } else {
                            paginationHtml += '<li class="page-item disabled"><span class="page-link" aria-hidden="true">‹</span></li>';
                        }


                        for (var i = 1; i <= response.last_page; i++) {
                            if (i === response.current_page) {
                                paginationHtml += '<li class="page-item active" aria-current="page"><span class="page-link">' + i + '</span></li>';
                            } else {
                                paginationHtml += '<li class="page-item"><a class="page-link" href="' + response.path + '?page=' + i + '">' + i + '</a></li>';
                            }
                        }


                        if (response.next_page_url) {
                            paginationHtml += '<li class="page-item"><a class="page-link" href="' + response.next_page_url + '" rel="next">›</a></li>';
                        } else {
                            paginationHtml += '<li class="page-item disabled"><span class="page-link" aria-hidden="true">›</span></li>';
                        }


                        $('#paginationLinks').html(paginationHtml);

                        var resultRangeInfo;

                        if (parseInt(response.from) > 0) {
                            resultRangeInfo = 'Showing <b>' + response.from + '</b> to <b>' + response.to + '</b> of <b>' + response.total + '</b> results';
                        } else {

                            resultRangeInfo = 'Showing <b>' + response.total + '</b> results';
                        }

                        $('#paginationLinks').prepend('<div class="d-flex justify-content-between align-items-center mb-3"><p class="small text-muted">' + resultRangeInfo + '</p></div>');
                    },
                    error: function(xhr, status, error) {

                        console.log('Error:', error);
                    }
                });
            }
        });
    </script>
    @endsection