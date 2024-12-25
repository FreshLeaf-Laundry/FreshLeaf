<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdmindashController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = User::count();
        $activeUsers = User::where('is_admin', 0)->count();
        $recentUsers = User::latest()->take(5)->get();

        return view('pages.admin.dashboard', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'recentUsers'
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'is_admin' => 'required|boolean'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['is_admin']
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Akun berhasil dibuat!');
    }


    public function deleteUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.dashboard')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Akun berhasil dihapus!');
    }
}
