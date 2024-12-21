<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\DB; // Ensure you import DB

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        $token = Password::createToken($user);

        $expiresAt = now()->addMinutes(60);

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
            'expires_at' => $expiresAt,
        ]);

        Mail::to($email)->send(new ResetPasswordMail($token, $email));

        return back()->with('status', 'Chúng tôi đã gửi một liên kết đặt lại mật khẩu vào email của bạn.');
    }
}
