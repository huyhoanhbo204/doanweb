<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function index($role = 'all', $active = 'all', $email = 'all')
    {
        // Start the query to get users
        $query = User::query();
    
        // Filter by role if it's not 'all'
        if ($role !== 'all') {
            $query->where('role', $role);
        }
    
        // Filter by status (active) if it's not 'all'
        if ($active !== 'all') {
            $query->where('status', $active);
        }
    
        // Filter by email if it's not 'all' and email is provided
        if ($email !== 'all' && $email !== '') {
            $query->where('email', 'like', '%' . $email . '%');
        }
    
        // Get the filtered users from the database
        $users = $query->paginate(5);
    
        // Check if the request expects JSON (e.g., from an API)
        if (request()->wantsJson()) {
            // Return the filtered users as JSON response
            return response()->json($users);
        }
    
        // If not expecting JSON, return a view
        return view('admin.users.list', compact('users'));
    }
    
}
