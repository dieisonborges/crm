<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;

use App\User;

class LoginController extends Controller
{
    
    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="LoginController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/


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
    protected $redirectTo = '/home';

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function validateLogin(Request $request)
    {
        
        /* -------- Implementa Contagem de LOGIN --------*/
        // Menor que 10 permite o login
        $users = User::where('email', $request->email)->select('id', 'login')->first();
        if($users){
            if($users->login>10){
                //Desativa o login para mais de 10 tentativas
                $users->status=0; 
            }
            $users->login = ($users->login)+1;
            $users->save();
        }
        /* --------- FIM Contagem -----------------------*/


        if($users){
            $this->validate(

                $request, [
                'email' => 'exists:users,email,status,1',
                // new rules here
                ],
                [
                    'exists' => 'A sua conta está desativada ou você excedeu o número de tentativas de login, entre em contato com o suporte.',
                ]

            );
        }

    }



    public function __construct()
    {
        //LOG -----------------------------------------------------------------
        $this->log("login");
        //----------------------------------------------------------------------
        
        $this->middleware('guest')->except('logout');
    }

    
}
