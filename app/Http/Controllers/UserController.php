<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index($role = 'all', $active = 'all', $email = 'all')
    {
        $query = User::query();
        if ($role !== 'all') {
            $query->where('role', $role);
        }
        if ($active !== 'all') {
            $query->where('status', $active);
        }
        if ($email !== 'all' && $email !== '') {
            $query->where('email', 'like', '%' . $email . '%');
        }
        $users = $query->paginate(5);
        if (request()->ajax()) {
            return response()->json([
                'data' => $users->items(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'next_page_url' => $users->nextPageUrl(),
                'prev_page_url' => $users->previousPageUrl(),
                'firstItem' => $users->firstItem()
            ]);
        }
        return view('admin.users.list', compact('users'));
    }

    public function edit($id)
    {
        $user_update = User::findOrFail($id);
        $user_update->birthday = \Carbon\Carbon::parse($user_update->birthday)->format('d-m-Y');
        return view('admin.users.edit', compact('user_update'));
    }
    public function update(\App\Http\Requests\Users\UserUpdateRequest $request, $id)
    {
        try {
            $affected = DB::table('users')
                ->where('id', $id)
                ->update([
                    'role' => $request->input('role'),
                    'status' => $request->input('status'),
                ]);
            if ($affected) {
                return redirect()->route('user.index')->with('success', 'Cập nhật user thành công');
            } else {
                return back()->with('error', 'Không có thay đổi nào được thực hiện.');
            }
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật user: ' . $e->getMessage());
            return back()
                ->withInput($request->all())
                ->with('error', 'Đã xảy ra lỗi trong quá trình cập nhật. Vui lòng thử lại!');
        }
    }
}
