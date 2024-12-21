<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResetPasswordMail extends Mailable
{
    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Đặt lại mật khẩu')->view('emails.reset_password');
    }
}
