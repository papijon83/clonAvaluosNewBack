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


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->group(['prefix' => 'bandeja-entrada'], function () use ($router) {
            $router->get('avaluos', 'BandejaEntradaController@avaluos');
            $router->get('isai', 'BandejaEntradaController@isai');
            $router->get('modificarestadoavaluo', 'BandejaEntradaController@ModificarEstadoAvaluo');
            $router->get('avaluosProximos', 'BandejaEntradaController@avaluosProximos');
            $router->get('buscaNotario', 'BandejaEntradaController@buscaNotario');
            $router->get('asignaNotarioAvaluo', 'BandejaEntradaController@asignaNotarioAvaluo');
            $router->post('esValidoAvaluo', 'BandejaEntradaController@esValidoAvaluo');
            $router->post('guardarAvaluo', 'BandejaEntradaController@guardarAvaluo');

<<<<<<< HEAD
            $router->post('pruebaDoc', 'PruebaDoc@pruebaGuardadoDB');
            $router->get('pruebaEjecuta', 'PruebaDoc@pruebaEjecutaProcedure');
=======
            $router->post('pruebaDoc', 'PruebaDoc@pruebaInserta');
>>>>>>> 23260d0d0c2d1f035855f7ced04cca6f8efa8360
        });
    });
});
