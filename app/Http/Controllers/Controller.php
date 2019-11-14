<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;


class Controller extends BaseController
{	
	public function apiResponse($status, $message, $result=null){
		if ($result){
			return response()->json([
				'status' => $status,
				'message' => $message,
				'result' => $result
			]);			
		}
		return response()->json([
			'status' => $status,
			'message' => $message,			
		]);
	}
}