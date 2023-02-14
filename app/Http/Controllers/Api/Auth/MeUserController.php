<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeUserController extends Controller
{
      public function index(Request $request)
    {
        return response()->json([
			'username' => Auth::user()->username,
			'email' => Auth::user()->email,
		]);
    }
}
