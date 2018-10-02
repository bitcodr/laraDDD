<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['middleware' => 'api.throttle','limit' => 10, 'expires' => 1], function ($api) {

  $api->group(['namespace' => 'App\Http\Services\Auth\Controller','prefix' => 'api/v1-0'], function ($api) {

      $api->post('login', 'AuthController@login');

  });

});
