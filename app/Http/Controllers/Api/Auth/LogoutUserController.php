<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutUserController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->user()->tokens()->delete();

        return response()->json('Logout Berhasil', 200);
    }
}
