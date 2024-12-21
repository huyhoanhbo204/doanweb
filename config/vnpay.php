<?php
return [
    'vnp_TmnCode' => env('VNP_TMN_CODE', 'U210H5M9'), // Terminal ID
    'vnp_HashSecret' => env('VNP_HASH_SECRET', '5M0L2GOBDXAZPTD5V3P74BZRESROX45M'), // Secret Key
    'vnp_Url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'), // Sandbox URL
    'vnp_ReturnUrl' => env('VNP_RETURN_URL', 'https://yourwebsite.com/vnpay_return'), // Return URL
    'vnp_IpnUrl' => env('VNP_IPN_URL', 'https://yourwebsite.com/vnpay_ipn'), // IPN URL
];
