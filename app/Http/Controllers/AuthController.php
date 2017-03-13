<?php

namespace Api\Http\Controllers;

use JWT;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
    	$credentials = $request->only('email', 'password');

    	try {
    		$token = JWTAuth::attempt($credentials);
    	} catch(JWTException $error) {
    		return response()->json(['error' => 'could_not_create_token'], 500);
    	}

    	if(!$token) {
    		return response()->json(['error' => 'invalid_credentials'], 401);
    	}

    	return response()->json([
    	    'success' => true,
    	    'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
