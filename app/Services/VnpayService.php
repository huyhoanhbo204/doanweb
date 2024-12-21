<?php

namespace App\Services;

class VnpayService
{
    public function createPaymentUrl($orderId, $amount)
    {
        $config = config('vnpay');
        $vnp_Url = $config['vnp_Url'];
        $vnp_TmnCode = $config['vnp_TmnCode'];
        $vnp_HashSecret = $config['vnp_HashSecret'];
        $vnp_ReturnUrl = $config['vnp_ReturnUrl'];
        $vnp_IpnUrl = $config['vnp_IpnUrl'];

        $vnp_Amount = $amount * 100;
        $vnp_TxnRef = $orderId;

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Payment for order #" . $orderId,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_IpnUrl" => $vnp_IpnUrl,
        ];

        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', urldecode($hashdata), $vnp_HashSecret);
        $paymentUrl = $vnp_Url . "?" . $hashdata . "&vnp_SecureHash=" . $secureHash;

        return $paymentUrl;
    }

    public function validateChecksum($data)
    {
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_SecureHash = $data['vnp_SecureHash'];
        unset($data['vnp_SecureHash'], $data['vnp_SecureHashType']);
        ksort($data);
        $hashdata = urldecode(http_build_query($data));
        $generatedHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        return $generatedHash === $vnp_SecureHash;
    }
}
