<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class LoginController
 * @package App\Http\Controllers\JWT
 */
abstract class LoginController extends Controller
{
    public $guard = '';

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json([
            'token' => $token,
        ]);
    }

    public function guard()
    {
        return Auth::guard($this->guard);
    }
}
