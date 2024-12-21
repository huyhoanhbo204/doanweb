<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <h1>Đặt lại mật khẩu</h1>
    <p>Chào bạn,</p>
    <p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấn vào liên kết dưới đây để đặt lại mật khẩu của bạn:</p>
    <a href="{{ url('password/reset/' . $token) }}">Đặt lại mật khẩu</a>
    <p>Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này hoặc bảo mật tài khoản của bạn.</p>
    <p>Liên kết để đặt lại mật khẩu sẽ hết hạn sau 10 phút.</p>
    <p>Chúc bạn một ngày tốt lành!</p>
</body>
</html>
