<?php

namespace App\Providers;

use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('GoogleDrive', function () {
        //     return new GoogleDrive;
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extend('gdrive', function ($app, $config) {
            $client = new \Google_Client;
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);

            $service =  new \Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folderId']);

            return new Filesystem($adapter);
        });
    }
}
