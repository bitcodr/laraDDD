<?php
/* Amirali roshanaei => mr.roshanae@gmail.com*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['middleware' => 'api.throttle','limit' => 50, 'expires' => 1], function ($api) {


    $api->group(['namespace' => 'App\Http\Aggregates\Customer\Controller', 'middleware' => 'api.auth', 'prefix' => 'api/v1-0'], function ($api) {
        
        $api->get('customers/{customer_id}', ['middleware' =>['role:ADMIN|CUSTOMER'],'uses'=>'CustomerController@customer']);
        
        $api->get('customers/{customer_id}/orders', ['middleware' =>['role:ADMIN|CUSTOMER'],'uses'=>'CustomerController@orders']);

        $api->get('customers', ['middleware' =>['role:ADMIN|CUSTOMER'],'uses'=>'CustomerController@customers']);

        $api->delete('customers/{customer_id}', ['middleware' =>['role:ADMIN'],'uses'=>'CustomerController@delete']);
        
        $api->put('customers/{customer_id}', ['middleware' =>['role:ADMIN|CUSTOMER'],'uses'=>'CustomerController@update_customer']);

        $api->patch('customers/{customer_id}/change_status', ['middleware' =>['role:ADMIN'],'uses'=>'CustomerController@customer_status']);

    });

});



$api->version('v1',['middleware' => 'api.throttle','limit' => 10, 'expires' => 1], function ($api) {

    $api->group(['namespace' => 'App\Http\Aggregates\Customer\Controller', 'prefix' => 'api/v1-0'], function ($api) {

        $api->post('customers', 'CustomerController@register_customer');
    
    });
    
});