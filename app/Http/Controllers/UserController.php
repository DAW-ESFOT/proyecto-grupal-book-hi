<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public static $messages = [];
    public static $rules = [
        'name'=> 'nullable|string',
        'last_name'=>'nullable|string',
        'nickname'=>'max:255',
        'email'=>'nullable|e-mail',
        'password'=>'nullable|confirmed',
        'image' => 'nullable|image',
        'ruc'=>'nullable|numeric',
        'bussiness_name'=>'nullable|max:255',
        'bussiness_address'=>'nullable|max:255',
        'bussiness_description'=>'nullable|string|max:1000'
    ];

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();
        return response()->json(compact('token','user'))
            ->withCookie(
              'token',
              $token,
              config('jwt.ttl'), // ttl => time to live
              '/', // path
              null, // domain
              config('app.env') !== 'local', // secure
              true, // httpOnly
              false,
              config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
            );

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'nickname' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'image',
            'ruc' => 'nullable|bigInteger|max:10',
            'bussiness_name' => 'nullable|string|max:100',
            'bussiness_address' => 'nullable|string|max:100',
            'bussiness_description' => 'nullable|text|max:1000'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $path = $request->image->store('public/images');
        $user = User::create([
            'name' => $request->get('name'),
            'last_name' => $request->get('last_name'),
            'nickname' => $request->get('nickname'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'image' => $path,
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(new UserResource($user, $token), 201)
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'), // ttl => time to live
                '/', // path
                null, // domain
                config('app.env') !== 'local', // secure
                true, // httpOnly
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
            );
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function show(User $user)
    {
        return response()->json(new UserResource($user), 200);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate(self::$rules, self::$messages);
        $user->update($request->all());
        return response()->json($user, 200);
    }
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ], 200);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesión."], 500);
        }
    }
}
