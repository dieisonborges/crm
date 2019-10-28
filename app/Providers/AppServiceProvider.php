<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Laravel usa o conjunto de caracteres utf8mb4 
        Schema::defaultStringLength(191);

        //Money Format Blade
        //BRL
        Blade::directive('moneyBRL', function ($amount) {            
            return "<?php echo 'R$ ' . number_format($amount, 2); ?>";
        });
        //USD        
        Blade::directive('moneyUSD', function ($amount) {
            return "<?php echo '$ ' . number_format($amount, 2); ?>";
        });

        //DateTime BRL
        Blade::directive('datetimeBRL', function ($datetime) {
            return "<?php echo date('d/m/Y H:i:s', strtotime($datetime)); ?>";
        });

        
        

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        /*
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );
        */
    }
}
