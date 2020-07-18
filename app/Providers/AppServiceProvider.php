<?php

namespace App\Providers;

use \App\Models\{
    Aluno
};

use \App\Observers\{
    AlunoObserver
};

use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        Aluno::observe(AlunoObserver::class);
    }
}
