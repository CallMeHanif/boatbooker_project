<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard_user()
    {

        $users = User::all();
        return view('admin.dashboard_user', compact('users'));
    }

    public function index_user()
    {
        $user = Auth::user();
        return view('index_user', compact('user'));
    }

    public function edit_user_profile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string',
            'call_num' => 'nullable|string',
            'password' => 'nullable|string|min:8',
        ]);

        // Menggunakan logika kondisional untuk mengubah hanya data yang diisi dalam formulir
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('call_num')) {
            $user->call_num = $request->call_num;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return Redirect::back()->with('success', 'Profile updated successfully');
    }
}
