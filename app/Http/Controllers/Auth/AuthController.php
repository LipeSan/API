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
            if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => true, 'message' => 'invalid credentials'], 401);
            }
    	} catch(JWTException $error) {
    		return response()->json(['error' => true, 'message' => 'could not create token'], 500);
    	}

        $user = JWTAuth::toUser($token);

    	return response()->json([
    	    'success' => true,
    	    'access_token' => $token,
            'token_type' => 'bearer',
            'data' => $user
        ]);
    }
}
