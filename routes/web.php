<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/api/employees', 'EmployeesController@index');
$router->post('/api/employees', 'EmployeesController@store');
$router->get('/api/employees/{id}', 'EmployeesController@show');
$router->put('/api/employees/{id}', 'EmployeesController@update');
$router->delete('/api/employees/{id}', 'EmployeesController@destroy');

$router->get('/api/bank-accounts', 'BankAccountsController@index');
$router->get('/api/provinces', 'ProvincesController@index');
$router->get('/api/cities', 'CitiesController@index');
$router->get('/api/positions', 'PositionsController@index');