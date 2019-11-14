<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library


class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance that guarded by auth and role middleware.
     *
     * @return void
     */
    public function __construct()
    {                
        $this->middleware('auth');
        $this->middleware('role:Administrator,Super Administrator', ['except' => ['logout']]);
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {                
        return $this->apiResponse(200, 'success', ['user' => Auth::User()]);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {        
        return $this->apiResponse(200, 'success', ['users' => User::all()]);        
    }

    /**
     * Get one user by id.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return $this->apiResponse(200, 'success', ['user' => $user]);

        } catch (\Exception $e) {

            return $this->apiResponse(201, 'user not found', null);
        }

    }

    /**
     * Invalidate provided token.
     *
     * @return Response
     */
    public function logout()
    {        
        Auth::invalidate();
        return $this->apiResponse(200, 'token invalidated', null);
    }
}