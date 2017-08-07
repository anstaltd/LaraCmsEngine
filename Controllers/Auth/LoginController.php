<?php

namespace Ansta\LaraCms\Controllers\Auth;

use Ansta\LaraCms\Controllers\Controller;
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
    /**
     * @var string
     */
    public $guard = '';

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @return mixed
     */
    public function guard()
    {
        return Auth::guard($this->guard);
    }
}
