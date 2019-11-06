<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Http\Controllers\SincronizarController;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\SincronizaLoja::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        //Atualiza a Cotação do Dolár ---------------------------------------------------
        $schedule->call(function () {

            //Busca Cotação Atual
            // set API Endpoint and API key 
            $endpoint = 'latest';
            $access_key = config('app.key_fixer_io');

            // Initialize CURL:
            $ch = curl_init(
                'http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.''
            );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Store the data:
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response:
            $exchangeRates = json_decode($json, true);

            //Logs ---------------------------------------
            DB::table('logs')->insert([
                'ip' => '127.0.0.1',
                'filename' => 'schedule | cambio',
                'created_at' => date("Y:m:d H:i:s"),
                'updated_at' => date("Y:m:d H:i:s"),
                'info' => json_encode($exchangeRates)
                ]);
            //End Logs -----------------------------------

            // Access the exchange rate values, e.g. GBP:
            //echo $exchangeRates['rates']['USD'];

            //For USD -----------------------------------------------------------------
            $usd = (($exchangeRates['rates']['BRL']) / ($exchangeRates['rates']['USD'] ));
            

            if($usd){
                DB::table('cambios')
                ->insert([
                'moeda' => 'USD',
                'valor' => $usd,
                'created_at' => date("Y:m:d H:i:s"),
                'updated_at' => date("Y:m:d H:i:s"),
                'descricao'  => 
                    "EUR: ".$exchangeRates['rates']['EUR']
                ." | BRL: ".$exchangeRates['rates']['BRL']
                ." | USD: ".$exchangeRates['rates']['USD']
                ." | CNY/RMB: ".$exchangeRates['rates']['CNY'],
                ]);
            }

            //For RMB/CNY -------------------------------------------------------------
            $rmb = (($exchangeRates['rates']['BRL']) / ($exchangeRates['rates']['CNY'] ));
            

            if($rmb){
                DB::table('cambios')->insert([
                'moeda' => 'CNY',
                'valor' => $rmb,
                'created_at' => date("Y:m:d H:i:s"),
                'updated_at' => date("Y:m:d H:i:s"),
                'descricao'  => 
                    "EUR: ".$exchangeRates['rates']['EUR']
                ." | BRL: ".$exchangeRates['rates']['BRL']
                ." | USD: ".$exchangeRates['rates']['USD']
                ." | CNY/RMB: ".$exchangeRates['rates']['CNY'],
                ]);
            }

            //For EUR -------------------------------------------------------------
            //Cotação Padrão é em EURO
            $eur = $exchangeRates['rates']['BRL'];

            if($eur){
                DB::table('cambios')->insert([
                'moeda' => 'EUR',
                'valor' => $eur,
                'created_at' => date("Y:m:d H:i:s"),
                'updated_at' => date("Y:m:d H:i:s"),
                'descricao'  => 
                    "EUR: ".$exchangeRates['rates']['EUR']
                ." | BRL: ".$exchangeRates['rates']['BRL']
                ." | USD: ".$exchangeRates['rates']['USD']
                ." | CNY/RMB: ".$exchangeRates['rates']['CNY'],
                ]);
            }            

            
            
        })->hourly();

        //})->everyMinute();  
        //FIM - Atualiza a Cotação do Dolár ----------------------------------------      
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
