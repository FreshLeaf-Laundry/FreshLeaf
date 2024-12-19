<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('pages.auth.login'); 
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);



        // cek remember me
        $remember = $request->boolean('remember');
        // Cek kredensial
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            // Redirect ke halaman yang diinginkan setelah login berhasil
            return redirect()->intended('/'); 
        }

        // Jika login gagal, kembali ke form dengan pesan kesalahan
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
}
