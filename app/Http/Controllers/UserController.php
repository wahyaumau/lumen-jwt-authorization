<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library


class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance that guarded by auth middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {        
        return response()->json(['user' => Auth::user()], 200);        
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
        $token = JWTAuth::getToken();
        return response()->json(['users' =>  User::all()], 200);
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

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
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
        return response()->json(['message' => 'provided token invalidated'], 200);
    }

}
