<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; //追記
use Laravel\Socialite\Facades\Socialite; //追記
use App\LineUser; //追記

class LineLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    
     public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function handleProviderCallback($provider)
    {
        $provided_user = Socialite::driver($provider)->user();

        $line_user = LineUser::where('provider', $provider)
        ->where('provided_user_id', $provided_user->id)
        ->first();
        
        if ($line_user === null) {
        // redirect confirm
        $line_user = LineUser::create([
        'name' => $provided_user->name,
        'provider' => $provider,
        'provided_user_id' => $provided_user->id,
        ]);
        }
        
        Auth::login($line_user);
        
        return redirect()->route('home');
    }
    
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

}

 

