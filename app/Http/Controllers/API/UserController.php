<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function profile() {
        $user = auth('api')->user();
        
      
        return $this->sendResponse($user, __('messages.Retrieved successfully'));
    }
    public function updateProfile(Request $request) {
        $data = request()->all();
        $response = [];
        $request->validate(
            [
                'name'        => 'required|max:255',
                'password'         => 'required|max:255',
                'email'             => ['email', Rule::unique('users', 'email')->ignore(auth('api')->user())],
                'type'              => 'required'
            ]
        );
        $user = auth('api')->user();
        if ( $user->update( $data ) ) {
            
            $response = [
                'user' => new User($user)
            ];
            return $this->sendResponse($response, __('messages.User Updated'));
        }else{
            return $this->sendResponse($response, __('messages.Something went wrong'));
    }
        
      
    }
}
