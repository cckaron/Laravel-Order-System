<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Schema;
use Socialite;
use Auth;
use App\User;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateUser($user);


        return redirect('/admin');
        //        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($user)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser){
            Auth::login($authUser, true);
            return $authUser;
        }

//        when you want to add user
        else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' => strtoupper('google'),
                'provider_id' => $user->id,
            ]);
            Auth::login($newUser, true);
        }
        return redirect('/admin');
    }


}
