<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/icommercefreeshipping'], function (Router $router) {
    $router->bind('configuration', function ($id) {
        return app('Modules\IcommerceFreeshipping\Repositories\ConfigurationRepository')->find($id);
    });
    
    $router->post('configurations', [
        'as' => 'admin.icommercefreeshipping.configuration.store',
        'uses' => 'ConfigurationController@store',
        'middleware' => 'can:icommercefreeshipping.configurations.create'
    ]);
   
    $router->put('configurations', [
        'as' => 'admin.icommercefreeshipping.configuration.update',
        'uses' => 'ConfigfreeshippingController@update',
        'middleware' => 'can:icommercefreeshipping.configurations.edit'
    ]);
   
});
