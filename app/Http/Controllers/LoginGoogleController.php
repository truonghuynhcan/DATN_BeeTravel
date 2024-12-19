<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginGoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
        
            $user = Socialite::driver('google')->user(); //mạng xã hội là gg
            $finduser = User::where('google_id', $user->id)->first(); //tìm kiếm xem tài khoản đã có trong data chưa
         
            if($finduser){
         
                Auth::login($finduser); //login ngay lập tức
                return redirect()->intended('/'); 
         
            }else{ //nếu không có
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'google_id'=> $user->id,
                        'password' => encrypt('1234567890')
                    ]);
         //login vào acc mới
                Auth::login($newUser);
        
                return redirect()->intended('/');
            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
