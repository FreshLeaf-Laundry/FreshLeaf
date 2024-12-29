<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UsermgtController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = User::count();
        $adminUsers = User::where('is_admin', 1)->count();
        $activeUsers = User::where('is_admin', 0)->count();
        $recentUsers = User::latest()->take(5)->get();

        return view('pages.admin.usermgt', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'recentUsers',
            'adminUsers'
        ));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'is_admin' => 'required|boolean',
                'address' => 'nullable|string|max:255'
            ]);

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_admin' => $validated['is_admin'],
                'address' => $validated['address']
            ]);

            return redirect()->route('admin.usermgt')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user.');
        }
    }


    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.usermgt')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('admin.usermgt')->with('success', 'Akun berhasil dihapus!');
    }
}
