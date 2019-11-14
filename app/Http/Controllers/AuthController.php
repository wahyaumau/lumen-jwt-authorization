<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {        
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $user = new User;
            $user->username = $request->username;
            $user->password = app('hash')->make($request->password);
            $user->save();

            // Default role is user
            $user->roles()->attach(2);
            return $this->apiResponse(200, 'User Created', ['user'=>$user]);
        } catch (\Exception $e) {            
            return $this->apiResponse(201, 'Registration Failed', null);
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {        
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);    

        $credentials = $request->only(['username', 'password']);
        try {
            if (!$token = Auth::attempt($credentials)) {
                return $this->apiResponse(201, 'Wrong credentials', null);
            }
        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return $this->apiResponse(500, 'Token Expired', null);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->apiResponse(500, 'Token Invalid', null);            
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return $this->apiResponse(500, $e->getMessage(), null);            
        }

        $user = User::where('username', $request->username)->first();
        $roles = $user->roles;
        $returned_roles = [];

        foreach ($roles as $key => $role) {
            unset($role->pivot);
            unset($role->created_at);
            unset($role->updated_at);
            array_push($returned_roles, $role);
        }            

        $token = array(
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL().' minutes',
            'roles' => $returned_roles
        );
        return $this->apiResponse(200, 'Authentication success', ['credential'=> $token]);
    }

}