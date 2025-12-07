<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    // Mengarahkan user ke Google/GitHub
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Menerima balikan data dari Google/GitHub
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // 1. Cek apakah user ini sudah pernah login pakai sosmed ini?
            $user = User::where($provider . '_id', $socialUser->getId())->first();

            if (!$user) {
                // 2. Jika belum, cek apakah emailnya sudah terdaftar manual?
                $user = User::where('email', $socialUser->getEmail())->first();

                if ($user) {
                    // Jika ada email sama, update ID sosmed-nya
                    $user->update([
                        $provider . '_id' => $socialUser->getId(),
                        'avatar' => $socialUser->getAvatar(),
                    ]);
                } else {
                    // 3. Jika benar-benar user baru, buat akun baru
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'username' => strtolower(str_replace(' ', '', $socialUser->getName())) . rand(100, 999), // Username otomatis
                        'email' => $socialUser->getEmail(),
                        'password' => bcrypt(Str::random(16)), // Password acak aman
                        $provider . '_id' => $socialUser->getId(),
                        'avatar' => $socialUser->getAvatar(),
                        'role' => 'member', // Default role
                    ]);
                }
            }

            // Login dan redirect
            Auth::login($user);
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login failed. Please try again.');
        }
    }
}