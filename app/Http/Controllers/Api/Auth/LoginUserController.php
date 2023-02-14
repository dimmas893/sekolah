<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginUserController extends Controller
{
    public function index(Request $request)
    {
         $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // return (new UserResource($user))->additional([
            //     'token' => $user->createToken('myAppToken')->plainTextToken,
            // ]);

			$token = $user->createToken('myAppToken')->plainTextToken;
			$row['id'] = $user->id;
			$row['nama'] = $user->username;
			$row['level'] = (int) $user->role;
			$row['token'] = $token;
			$row['message'] = 'Selamat Datang';
			return response()->json($row, 200);
        }

        return response()->json([
            'error' => [
				'Password salah',
				'Username Salah'
			],
        ], 401);
    }
}
