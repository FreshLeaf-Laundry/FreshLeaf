<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Menampilkan form registrasi (jika ada)
    public function showRegistrationForm()
    {
        return view('pages.auth.register'); // Ganti dengan view yang sesuai
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Meng-hash password
            'is_admin' => '0', // Mengatur role menjadi 'user'
        ]);

        // Redirect atau memberikan respon setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
}
