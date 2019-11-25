<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;      //importando a classe Schema pra string ficar maior.

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()      //toda vez que o Laravel rodar, esse método é executado
    {
        //padrão do mySQL, com o 191 garante que sempre vai funcionar.
        Schema::defaultStringLength(191);
    }
}
