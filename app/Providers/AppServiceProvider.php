<?php

namespace App\Providers;

use App\Services\Interfaces\IPaymentDateCalculator;
use App\Services\PaymentDateCalculator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        IPaymentDateCalculator::class => PaymentDateCalculator::class
    ];

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
        //
    }
}
