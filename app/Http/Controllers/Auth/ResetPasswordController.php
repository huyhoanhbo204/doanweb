<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();

        if (!$passwordReset || now()->greaterThan($passwordReset->expires_at)) {
            return redirect()->route('password.request')->withErrors(['token' => 'This password reset token is invalid or expired.']);
        }

        return view('auth.passwords.reset', ['token' => $token, 'email' => $passwordReset->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $email = $request->email;
        $token = $request->token;
        $password = $request->password;

        DB::beginTransaction();

        try {
            $response = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = bcrypt($password);
                    $user->save();
                }
            );

            if ($response == Password::PASSWORD_RESET) {
                DB::table('password_resets')->where('email', $email)->delete();

                DB::commit();

                return redirect()->route('login')->with('status', 'Mật khẩu của bạn đã được đặt lại thành công.');
            }
            DB::rollBack();
            return back()->withErrors(['email' => [trans($response)]]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['email' => 'Có lỗi xảy ra. Vui lòng thử lại sau.']);
        }
    }
}
