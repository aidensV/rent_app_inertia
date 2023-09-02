<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        // dd(bcrypt("12345678"));
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $data = [
            "message" => "success",
            "data" => $user,
            "access_token"=> $token
        ];
        return response()
            ->json($data);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(
                [
                    "message" => "Success",
                    "data" => []
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "message" => $th->getMessage(),
                    "data" => []
                ],500
            );
        }
    }
}
