<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{   //Login thủ công
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('status', 'Bạn đã đăng nhập.');
        }
        return view('auth.login');
    }
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('status', 'Bạn đã đăng nhập.');
        }

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user->email_verified_at) {
            return back()->with('status', 'Tài khoản của bạn chưa được xác thực. Vui lòng kiểm tra email.');
        }

        if ($user->status !== 'active') {
            return back()->with('status', 'Tài khoản của bạn hiện tại bị khóa, vui lòng liên hệ admin.');
        }

        if (Hash::check($validated['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('home')->with('status', 'Đăng nhập thành công!');
        } else {
            return back()->withErrors(['password' => 'Mật khẩu không đúng.']);
        }
    }

    //End-login thủ công

    //Goggle-login
    public function redirectToGoogle()
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('status', 'Bạn đã đăng nhập.');
        }

        return Socialite::driver('google')->redirect();
    }
    public function logout()
    {
        Auth::logout();
        session()->forget('user');
        return redirect()->route('login')->with('status', 'Bạn đã đăng xuất.');
    }



    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::updateOrCreate(
                    ['email' => $googleUser->getEmail()],
                    [
                        'google_id' => $googleUser->getId(),
                        'fullname' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'password' => bcrypt(Str::random(16)),
                        'status' => 'active',
                        'role' => 'user',
                        'email_verified_at' => now(),
                    ]
                );
            }
            if ($user->status !== 'active') {
                return redirect()->route('login')->with('status', 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ admin.');
            }
            Auth::login($user);
            return redirect()->route('home')->with('status', 'Đăng nhập với Google thành công!');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'error' => 'Có lỗi xảy ra khi đăng nhập với Google: ' . $e->getMessage(),
            ]);
        }
    }
    //End-login gg

    public function editProfile()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('status', 'Vui lòng đăng nhập để truy cập.');
        }
        return view('auth.update');
    }

    public function showChangePasswordForm()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('status', 'Vui lòng đăng nhập để truy cập.');
        }
        return view('auth.change_password');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();


        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'fullname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthday' => 'nullable|date|before:-18 years',
            'address' => 'nullable|string|max:255',
        ]);


        DB::beginTransaction();

        try {
            $user->update([
                'email' => $validated['email'],
                'fullname' => $validated['fullname'],
                'phone' => $validated['phone'] ?? $user->phone,
                'birthday' => $validated['birthday'] ?? $user->birthday,
                'address' => $validated['address'] ?? $user->address,
            ]);

            DB::commit();

            return redirect()->back()->with('status', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        // Xác thực dữ liệu
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Đổi mật khẩu thành công!');
    }
}
