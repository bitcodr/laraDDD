<?php
/* Amirali roshanaei => mr.roshanae@gmail.com*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['middleware' => 'api.throttle','limit' => 50, 'expires' => 1], function ($api) {


    $api->group(['namespace' => 'App\Http\Aggregate\Category\Controller', 'middleware' => 'api.auth', 'prefix' => 'api/v1-0'], function ($api) {

        $api->post('supplier/{user_id}/categories', ['middleware' =>['role:SUPPLIER'],'uses'=>'CategoryController@addCategory']);
        
        $api->get('supplier/{user_id}/category/{category_id}', ['middleware' =>['role:SUPPLIER'],'uses'=>'CategoryController@getCategory']);
        
        $api->get('supplier/{user_id}/categories', ['middleware' =>['role:SUPPLIER'],'uses'=>'CategoryController@getCategories']);

        $api->delete('supplier/{user_id}/category/{category_id}', ['middleware' =>['role:SUPPLIER'],'uses'=>'CategoryController@deleteCategory']);
        
        $api->put('supplier/{user_id}/category/{category_id}', ['middleware' =>['role:SUPPLIER'],'uses'=>'CategoryController@updateCategory']);

    });


});
