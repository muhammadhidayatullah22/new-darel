<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Metode untuk register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:guru,kepala_sekolah',
        ]);

        // Set default image path
        $imagePath = 'images/default.png';

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'image' => $imagePath,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // Metode untuk login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('username', 'password'))) {
            // Mengarahkan kembali dengan pesan error
            return redirect()->back()->with('error', 'Email atau password salah.');
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Redirect to dashboard
        return redirect()->route('dashboard')->with('token', $token);
    }

    // Metode untuk logout
public function logout(Request $request)
    {
        // Hapus semua token pengguna
        $request->user()->tokens()->delete();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembalikan respons JSON
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function showLoginForm()
    {
        return view('login');
    }
}