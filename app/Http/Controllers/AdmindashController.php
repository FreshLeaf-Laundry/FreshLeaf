<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdmindashController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_admin', 0)->count(); // Regular users
        $recentUsers = User::latest()->take(5)->get(); // Get 5 most recent users

        return view('pages.admin.dashboard', compact('totalUsers', 'activeUsers', 'recentUsers'));
    }

    public function store(Request $request)
    {
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

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.dashboard')->with('error', 'You cannot delete yourself!');
        }

        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
    }
}
