<?php
/* Amirali roshanaei => mr.roshanae@gmail.com*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['middleware' => 'api.throttle','limit' => 50, 'expires' => 1], function ($api) {


    $api->group(['namespace' => 'App\Http\Aggregate\AddressBook\Controller', 'middleware' => 'api.auth', 'prefix' => 'api/v1-0'], function ($api) {

        $api->post('users/{user_id}/address-books', ['middleware' =>['role:SUPPLIER|CUSTOMER'],'uses'=>'AddressBookController@addAddressBook']);
        
        $api->get('users/{user_id}/address-books', ['middleware' =>['role:SUPPLIER|CUSTOMER'],'uses'=>'AddressBookController@getAddressBooks']);
        
        $api->get('users/{user_id}/address-books/{address_id}', ['middleware' =>['role:SUPPLIER|CUSTOMER'],'uses'=>'AddressBookController@getAddressBook']);

        $api->delete('users/{user_id}/address-books/{address_id}', ['middleware' =>['role:SUPPLIER|CUSTOMER'],'uses'=>'AddressBookController@deleteAddressBook']);
        
        $api->put('users/{user_id}/address-books/{address_id}', ['middleware' =>['role:SUPPLIER|CUSTOMER'],'uses'=>'AddressBookController@updateAddressBook']);

    });


});
