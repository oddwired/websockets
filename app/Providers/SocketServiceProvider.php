<?php
/**
 * Created by PhpStorm.
 * User: kshem
 * Date: 4/29/19
 * Time: 4:21 PM
 */

namespace App\Providers;


use App\SocketApp;
use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\Apps\AppProvider;

class SocketServiceProvider implements AppProvider
{

    /**  @return array[BeyondCode\LaravelWebSockets\AppProviders\App] */
    public function all(): array
    {
        return SocketApp::all()->map(function($socket_config){
            return $this->initialize($socket_config);
        })->all();
    }

    public function findById($appId): ?App
    {
        return $this->initialize(SocketApp::find($appId));
    }

    public function findByKey(string $appKey): ?App
    {
        return $this->initialize(SocketApp::where("key", $appKey)->first());
    }

    public function findBySecret(string $appSecret): ?App
    {
        return $this->initialize(SocketApp::where("secret", $appSecret)->first());
    }

    private function initialize($socket_config): ?App {
        if(!$socket_config)
            return null;

        $app = new App($socket_config->id, $socket_config->key, $socket_config->secret);
        $app->setName($socket_config->name)
            ->enableClientMessages($socket_config->enable_client_messages)
            ->enableStatistics($socket_config->enable_statistics);
        return $app;
    }
}