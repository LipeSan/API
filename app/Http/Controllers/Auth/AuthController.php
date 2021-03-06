<?php

namespace Api\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Api\Http\Controllers\Controller;
use JWT;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
    	$credentials = $request->only('email', 'password');
    	try {
            $token = JWTAuth::attempt($credentials);

            if(!$token) {
                return response()->json([
                    'error' => [
                        'status' => 401,
                        'message' => 'invalid credentials'
                    ]
                ], 401);
            }
    	} catch(JWTException $error) {
    		return response()->json([
    		    'error' => [
                    'status' => 500,
    		        'message' => 'could not create token'
                ]
            ], 500);
    	}

        $user = JWTAuth::toUser($token);

    	return response()->json([
    	    'result' => [
                'status' => 200,
                'access_token' => $token,
                'token_type' => 'bearer',
                'profile' => $user
            ]
        ], 200);
    }

    public function refreshToken(Request $request)
    {
        if(!$token = $request->token) {
            return response()->json([
                'result' => [
                    'status' => 401,
                    'errors' => 'token not sended',
                ]
            ], 401);
        }
        try {
            return response()->json([
                'result' => [
                    'status' => 200,
                    'token' => JWTAuth::refresh($token),
                ]
            ], 401);
        } catch(JWTException $error) {
            return response()->json([
                'result' => [
                    'status' => 401,
                    'errors' => $error->getMessage(),
                ]
            ], 401);
        }
    }
}
