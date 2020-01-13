<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades;
use Socialite;
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
    protected $redirectTo = '/';

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
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        // dd($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->user();
        
        if (User::where('provider_id', null)->where('email', $provider_user->email)->first()) {
            return redirect()->route('login', app()->getLocale())->with('fail', 'Account exists with Email');
        }

        if ($provider == 'google') {
            if (User::where('provider', 'facebook')->where('email', $provider_user->email)->first()) {
                return redirect()->route('login', app()->getLocale())->with('fail', 'Email used for Authentication with Facebook Already');
            }
        }

        if ($provider == 'facebook') {
            if (User::where('provider', 'google')->where('email', $provider_user->email)->first()) {
                return redirect()->route('login', app()->getLocale())->with('fail', 'Email used for Authentication with Google Already');
            }
        }
        

        $user = $this->userFindorCreate($provider_user, $provider);
        Auth::login($user, true);
        return redirect('/');
        // $token = $user->token;
    }

    public function userFindorCreate($p_user, $provider)
    {
        $user = User::where('provider_id', $p_user->id)->first();

        if (!$user) {
            $user = new User;
            if (Role::where('name', 'user')) {
                $user->assignRole('user');
            } else {
                Role::create(['name' => 'writer']);
                $user->assignRole('user');
            }
            $user->name = $p_user->getName();
            $user->email = $p_user->getEmail();
            $user->provider = $provider;
            $user->provider_id = $p_user->getId();
            $user->save();
        }

        return $user;
    }
}
