<!DOCTYPE html>
<html>
<head>
    <title>Kích hoạt tài khoản</title>
</head>
<body>
    <h1>Chào {{ $user->fullname }}!</h1>
    <p>Cảm ơn bạn đã đăng ký tài khoản. Vui lòng nhấn vào link dưới đây để kích hoạt tài khoản của bạn:</p>
    <a href="{{ $activationUrl }}">Kích hoạt tài khoản</a>
</body>
</html>
