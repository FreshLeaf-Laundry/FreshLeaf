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
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials =$request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);



        // cek remember me
        $remember = $request->boolean('remember');
        // Cek kredensial

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect to admin dashboard if user is admin
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/');
        }

        // Jika login gagal, kembali ke form dengan pesan kesalahan
        return back()->withErrors([
            'Email atau Password Tidak Sesuai',
        ]);
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
}
