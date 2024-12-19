<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @include('admin.layouts.style')
</head>

<body>
    <div class="d-flex min-vh-100 position-relative">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>

        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column flex-shrink-0 bg-white border-end" id="sidebar">
            @include('admin.layouts.sidebar')
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-content">
            <!-- Top Bar -->
            <nav class="navbar navbar-expand navbar-light bg-white border-bottom sticky-top">
                @include('admin.layouts.topbar')
            </nav>

            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">@yield('title')</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item">@yield('title')</li>
                                <li class="breadcrumb-item active">@yield('title_new')</li>
                            </ol>
                        </nav>
                    </div>
                    @if(Route::currentRouteName() != 'users.index')
                    <a href="@yield('link')" class="btn btn-primary">Thêm mới</a>
                    @endif

                </div>
                <!-- Filters Section -->
                @yield('content')
            </div>
        </div>
        <!-- Main Content Area -->

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    @include('admin.layouts.js')

    <!-- Pagination Script -->
    @yield('script')
    </div>
</body>

</html>