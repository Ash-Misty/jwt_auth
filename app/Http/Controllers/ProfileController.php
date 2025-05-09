<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        // Get JWT from cookie
        $token = request()->cookie('jwt_token');

        if (!$token) {
            return redirect('/login');
        }

        try {
            // Decode JWT
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            // Get email from payload
            $email = $decoded->email ?? null;

            if (!$email) {
                return redirect('/login')->withErrors(['Token missing email claim']);
            }

            // Find user
            $user = User::where('email', $email)->first();

            if (!$user) {
                return redirect('/login')->withErrors(['User not found']);
            }

            // Pass user to view
            return view('profile', compact('user'));

        } catch (\Exception $e) {
            // Token invalid or expired
            return redirect('/login')->withErrors(['Invalid or expired token']);
        }
    }
}
