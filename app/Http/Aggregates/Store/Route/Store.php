<?php
/* Amirali roshanaei => mr.roshanae@gmail.com*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['middleware' => 'api.throttle','limit' => 50, 'expires' => 1], function ($api) {


    $api->group(['namespace' => 'App\Http\Aggregate\Store\Controller', 'middleware' => 'api.auth', 'prefix' => 'api/v1-0'], function ($api) {

        $api->post('categories/{category_id}/stores', ['middleware' =>['role:SUPPLIER'],'uses'=>'StoreController@addStore']);
        
        $api->get('categories/{category_id}/stores/{store_id}', ['middleware' =>['role:SUPPLIER'],'uses'=>'StoreController@getStore']);
        
        $api->get('categories/{category_id}/stores', ['middleware' =>['role:SUPPLIER'],'uses'=>'StoreController@getStores']);

        $api->delete('categories/{category_id}/stores/{store_id}', ['middleware' =>['role:SUPPLIER'],'uses'=>'StoreController@deleteStore']);
        
        $api->put('categories/{category_id}/stores/{store_id}', ['middleware' =>['role:SUPPLIER'],'uses'=>'StoreController@updateStore']);

    });


});
