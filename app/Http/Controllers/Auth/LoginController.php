<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        //validate the incoming request
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        //check if the user is exist
        $user = User::where('username', $request->username)->first();

        //if the user is exist
        if ($user) {
            //check if the password is match
            if (Hash::check($request->password, $user->password)) {

                $this->clearLoginAttempts($request);

                $this->authenticated($request, $this->guard()->user());

                $data = [
                    'user' => $user,
                    'redirect' => $this->redirectTo
                ];

                return $this->setResponse(true, 'Login success', $data);
            } else {
                return $this->setResponse(false, 'Password does not match', null);
            }
        } else {
            return $this->setResponse(false, 'User not found', null);
        }
    }
}
