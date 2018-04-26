<?php
/**
 * User: ricardo
 * Date: 24/04/18
 * Time: 08:19 PM
 */

namespace App\Service\sale;
use Illuminate\Support\ServiceProvider;

class SaleService extends ServiceProvider{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('App\Repository\sale\SaleInterface', 'App\Repository\sale\SaleRepository');
    }

}