<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

//Log
use App\Http\Controllers\Log;
use App\Http\Controllers\LogController;

use Gate; 

class LojaFranqueadoController extends Controller
{
    //

    /* ----------------------- LOGS ----------------------*/

    private function log($info){
        //path name
        $filename="FranquiaController";

        $log = new LogController;
        $log->store($filename, $info);
        return null;     
    }

    /* ----------------------- END LOGS --------------------*/

    public function index()
    {
        //
        if(!(Gate::denies('read_franqueado'))){

            $user = Auth::user();

            $franquias = $user->franquia()->get(); 

            //LOG ----------------------------------------------------------------------------------------
            $this->log("loja_franqueado.index");
            //--------------------------------------------------------------------------------------

                    return Redirect::to("https://ecardu.me/tglebeaw3dhtc4e/");

                    /*

                    $username="teste";
                    $password="teste@123";
                    $url="https://ecardu.me/tglebeaw3dhtc4e/";
                    $cookie="/var/www/html/cookie.txt";

                    $postdata = "log=". urlencode($username) ."&pwd=". urlencode($password)."&wp-submit=Log%20In&redirect_to=". $url ."wp-admin/&testcookie=1";
                    $ch = curl_init();
                    curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);  
                    curl_setopt ($ch, CURLOPT_COOKIESESSION, 'TRUE');
                    curl_setopt ($ch, CURLOPT_URL, $url . "wp-login.php");
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
                    curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
                    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
                    curl_setopt ($ch, CURLOPT_REFERER, $url . "wp-admin/");
                    curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
                    curl_setopt ($ch, CURLOPT_POST, 1);
                    $result = curl_exec ($ch);
                    curl_close($ch);

                    echo $result;

                    exit;
                    die();

                    */               
                    
                    

                    //return view('loja_franqueado.index');
        }
        else{
            return view('errors.403');
        }
    }
}
