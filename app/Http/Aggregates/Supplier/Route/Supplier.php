<?php
/* Amirali roshanaei => mr.roshanae@gmail.com*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['middleware' => 'api.throttle','limit' => 50, 'expires' => 1], function ($api) {


    $api->group(['namespace' => 'App\Http\Aggregates\Supplier\Controller', 'middleware' => 'api.auth', 'prefix' => 'api/v1-0'], function ($api) {
        
        $api->get('suppliers/{supplier_id}', ['middleware' =>['role:ADMIN|SUPPLIER'],'uses'=>'SupplierController@supplier']);
        
        $api->get('suppliers/{supplier_id}/categories', ['middleware' =>['role:ADMIN|SUPPLIER'],'uses'=>'SupplierController@categories']);

        $api->get('suppliers', ['middleware' =>['role:ADMIN|SUPPLIER'],'uses'=>'SupplierController@suppliers']);

        $api->delete('suppliers/{supplier_id}', ['middleware' =>['role:ADMIN'],'uses'=>'SupplierController@delete']);
        
        $api->put('suppliers/{supplier_id}', ['middleware' =>['role:ADMIN|SUPPLIER'],'uses'=>'SupplierController@update_supplier']);

        $api->patch('suppliers/{supplier_id}/change_status', ['middleware' =>['role:ADMIN'],'uses'=>'SupplierController@supplier_status']);

    });

});



$api->version('v1',['middleware' => 'api.throttle','limit' => 10, 'expires' => 1], function ($api) {

    $api->group(['namespace' => 'App\Http\Aggregates\Supplier\Controller', 'prefix' => 'api/v1-0'], function ($api) {

        $api->post('suppliers', 'SupplierController@register_supplier');
    
    });
    
});