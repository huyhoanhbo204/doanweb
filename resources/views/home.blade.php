// resources/views/home.blade.php
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
</head>
<body>
    <h1>Chào mừng {{ Auth::user()->fullname }}</h1>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Đăng xuất</button>
    </form>
</body>
</html>
