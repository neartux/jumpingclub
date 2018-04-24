<?php
/**
 * User: ricardo
 * Date: 23/04/18
 * Time: 07:51 PM
 */

namespace App\Service\client;


use Illuminate\Support\ServiceProvider;

class ClientService extends ServiceProvider {


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
        $this->app->bind('App\Repository\client\ClientInterface', 'App\Repository\client\ClientRepository');
    }

}