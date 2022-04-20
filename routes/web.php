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
// Only authenticated users
$router->group(['middleware' => 'auth', 'namespace' => 'Authenticated\v1'], function () use ($router) {
    // Test home URL just to check Lumen is working with Auth
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    $router->group(['prefix' => 'employee', 'namespace' => 'Employee'], function () use ($router) {
        // Add employee
        $router->post('/', [
            'as' => 'add_employee',
            'uses' => 'EmployeeController@insert',
        ]);

        $router->group(['prefix' => 'shifts', 'namspace' => 'Shifts'], function () use ($router) {
            // Add shift
            $router->post('/{employeeId}', [
                'as' => 'add_shift',
                'uses' => 'ShiftController@insert',
            ]);

            // List shifts
            $router->get('/{employeeId}', [
                'as' => 'add_shift',
                'uses' => 'ShiftController@list',
            ]);
        });
    });


});
