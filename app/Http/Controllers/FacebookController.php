<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
  
class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
           
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
        
            $user = Socialite::driver('facebook')->user();
            dd($user);
       
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}