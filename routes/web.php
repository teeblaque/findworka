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
    return response()->json("Hello world", 200);
});


$router->group(['prefix' => 'api/v1/'], function () use ($router) {
    $router->get('books', 'HomeController@books');
    $router->post('savebooks', 'HomeController@storebooks');

    $router->post('add_comment', 'HomeController@add_comment');
    $router->get('book_comment/{book_id}', 'HomeController@book_comment');
    $router->get('book_character/{book_id}', 'HomeController@book_character');

    //character endpoint
    $router->post('savecharacter', 'HomeController@storecharacter');
    $router->get('character/{param}', 'HomeController@character');

    //comment endpoint
    $router->get('comment', 'HomeController@comment');
});
