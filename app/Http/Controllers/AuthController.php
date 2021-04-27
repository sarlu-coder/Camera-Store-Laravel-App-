<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exceptions\AppException;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request) 
    { 	
		$requestData = $request->validated();
		$insert_array = [
			'name' 		=> $requestData['name'],
			'email' 	 		=> $requestData['email'],
			'password' 	 		=> bcrypt($requestData['password']),
			'address'    		=> $requestData['address'],
			'mobile_number'    	=> $requestData['mobile_number']
		];
		User::register_user($insert_array);

		return  response()->success();
	}

	public function login(LoginRequest $request)
	{
		$requestData = $request->validated();
		$user = User::get_user_by_email($requestData['email']);
		$user->token = $user->createToken('MyApp')->accessToken;
    	$user = $user->toArray();
		return response()->data($user);
        
	}
}
