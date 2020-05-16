<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function() use($router)
{
    $router->get('schedules','ScheduleController@index');
    $router->post('schedules','ScheduleController@store');
    $router->get('schedules/{schedule}','ScheduleController@show');
    $router->put('schedules/{schedule}','ScheduleController@update');
    $router->patch('schedules/{schedule}','ScheduleController@update');
    $router->delete('schedules/{schedule}','ScheduleController@destroy');
});