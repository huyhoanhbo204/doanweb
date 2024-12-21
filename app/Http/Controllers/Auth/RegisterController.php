<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationMail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'fullname' => $validated['fullname'],
                'phone' => $validated['phone'] ?? null,
                'birthday' => $validated['birthday'] ?? null,
                'address' => $validated['address'] ?? null,
                'role' => 'user',
                'status' => 'inactive',
            ]);

            Mail::to($user->email)->send(new ActivationMail($user));
            DB::commit();
            return redirect()->route('login')->with('status', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
    public function activate($email)
    {
        $user = User::where('email', $email)->first();
        if ($user && $user->status == 'inactive') {
            $user->status = 'active';
            $user->email_verified_at = now();
            $user->save();
            return redirect()->route('login')->with('status', 'Tài khoản của bạn đã được kích hoạt và email của bạn đã được xác nhận.');
        } else {
            return redirect()->route('login')->withErrors(['error' => 'Tài khoản không tồn tại hoặc đã được kích hoạt.']);
        }
    }
}
