<?php

// Secret key mà bạn nhận từ VNPay
$vnp_HashSecret = "5M0L2GOBDXAZPTD5V3P74BZRESROX45M";

// Lấy tất cả dữ liệu trả về từ VNPay
$vnp_Params = $_GET;

// Lấy SecureHash từ VNPay trả về
$vnp_SecureHash = $vnp_Params['vnp_SecureHash'];

// Xóa SecureHash khỏi tham số trước khi tạo hash lại
unset($vnp_Params['vnp_SecureHash']);
unset($vnp_Params['vnp_SecureHashType']);

// Sắp xếp mảng tham số theo thứ tự từ a-z
ksort($vnp_Params);

$hashData = "";
foreach ($vnp_Params as $key => $value) {
    $hashData .= $key . "=" . $value . "&";
}

// Cắt bỏ dấu '&' cuối cùng
$hashData = rtrim($hashData, '&');

// Tạo hash mới với HMAC SHA512
$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

// Kiểm tra nếu SecureHash khớp
if ($secureHash === $vnp_SecureHash) {
    // Chữ ký hợp lệ, giao dịch thành công
    echo "Giao dịch thành công!";
} else {
    // Chữ ký không hợp lệ, giao dịch thất bại
    echo "Giao dịch thất bại! Sai chữ ký.";
}
