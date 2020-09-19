<?php

namespace App\Providers;

use \App\Models\{
    Aluno,
    Plan,
    Tenant
};

use \App\Observers\{
    AlunoObserver,
    PlanObserver,
    TenantObserver
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
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
    }
}
