<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'user_status' => 2])) {
            return response()->json(['Auth_attempt' => true], 401);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!($token = $this->guard()->attempt($validator->validated()))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // dd($request->all());
        $validatorName = Validator::make($request->all(), [
            'name' => 'required|unique:users|string|between:2,100',
        ]);
        if ($validatorName->fails()) {
            return response()->json(['validatorName' => true], 400);
        }
        $validatorUsername = Validator::make($request->all(), [
            'username' => 'required|unique:users|string|between:2,100',
        ]);
        if ($validatorUsername->fails()) {
            return response()->json(['validatorUsername' => true], 400);
        }
        $validatorEmail = Validator::make($request->all(), [
            'email' => 'required|unique:users|string|email|max:100',
        ]);
        if ($validatorEmail->fails()) {
            return response()->json(['validatorEmail' => true], 400);
        }
        $validatorPassword = Validator::make($request->all(), [
            'password' => 'required|string|confirmed|min:6',
        ]);
        if ($validatorPassword->fails()) {
            return response()->json(['validatorPassword' => true], 400);
        }

        $user = User::create(array_merge($validatorName->validated(), $validatorUsername->validated(), $validatorEmail->validated(), $validatorPassword->validated(), ['password' => bcrypt($request->password)]));

        return response()->json(['status' => 'success', 'message' => 'User successfully registered', 'user' => $user], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['status' => 'success', 'message' => 'User successfully signed out'], 201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        $user[] = $this->guard()->user(); //or // $user = auth()->user();

        $destinationPath = '/assets/backend/img/user_profile/';

        foreach ($user as $key => $value) {
            $value->user_photo = url('/') . $destinationPath . $value->user_photo;
        }

        // dd($user);

        return response()->json($user);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'success' => true,
            'expires_in' => $this->guard()
                ->factory()
                ->getTTL(), //* 6000
            'user' => $this->guard()->user(),
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
