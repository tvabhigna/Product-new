<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Login
     *
     * @param Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
            $user = User::where('email',$request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)){
                return response ([
                    'message' => ['These credentials does not match our records.']
                ],404);
            }
            $token = $user->createToken('my-app-token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response);
        
        // }
    }

    /**
     * Logout
     *
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
