<?php

namespace App\Http\Controllers;

use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        Mail::to('huyhoanhbo388@gmail.com')->send(new ExampleMail());
        return 'Email đã được gửi!';
    }
}
