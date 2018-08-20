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

// Start session for all routes.
@session_start();

$router->get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

// Pieces
// -----------
// READ piece(s)
$router->get('pieces', [
    'as' => 'pieces.index',
    'uses' => 'PiecesController@index',
]);
$router->get('pieces/{pieceId:[\d]+}', [
    'as' => 'pieces.show',
    'uses' => 'PiecesController@show',
]);

// Orders
// ------
$router->group(['prefix' => 'orders'], function () use ($router) {
    // CREATE order
    $router->get('create', [
        'as' => 'orders.create',
        'uses' => 'OrdersController@create',
    ]);
    $router->get('store', [
        'as' => 'orders.store',
        'uses' => 'OrdersController@store',
    ]);

    // READ order(s)
    $router->get('', [
        'as' => 'orders.index',
        'uses' => 'OrdersController@index',
    ]);
    $router->get('{orderId:[\d]+}', [
        'as' => 'orders.show',
        'uses' => 'OrdersController@show',
    ]);

    // UPDATE order in session
    $router->get('add/{outfitId:[\d]+}', [
        'as' => 'orders.add',
        'uses' => 'OrdersController@add',
    ]);

    // DELETE orders in session
    $router->get('clear', [
        'as' => 'orders.clear',
        'uses' => 'OrdersController@clear',
    ]);
});

// Outfits
// -------
// READ outfits
$router->get('outfits', [
    'as' => 'outfits.index',
    'uses' => 'OutfitsController@index',
]);
$router->get('outfits/{outfitId:[\d]+}', [
    'as' => 'outfits.show',
    'uses' => 'OutfitsController@show',
]);

// Users
// -----
$router->group(['prefix' => 'users'], function () use ($router) {
    // LOGIN user
    $router->get('login', [
        'as' => 'auth.create',
        'uses' => 'AuthController@create',
    ]);
    $router->post('login', [
        'as' => 'auth.login',
        'uses' => 'AuthController@login',
    ]);

    // LOGOUT user
    $router->get('logout', [
        'as' => 'auth.logout',
        'uses' => 'AuthController@logout',
    ]);

    // CREATE user
    $router->get('register', [
        'as' => 'users.create',
        'uses' => 'UsersController@create',
    ]);
    $router->post('', [
        'as' => 'users.store',
        'uses' => 'UsersController@store',
    ]);

    // READ user
    $router->get('{userId:[\d]+}', [
        'as' => 'users.show',
        'uses' => 'UsersController@show',
    ]);

    // UPDATE user
    $router->get('{userId:[\d]+}/edit', [
        'as' => 'users.edit',
        'uses' => 'UsersController@edit',
    ]);
    $router->post('{userId:[\d]+}', [
        'as' => 'users.update',
        'uses' => 'UsersController@update',
    ]);

    // DELETE user
    $router->get('{userId:[\d]+}/delete', [
        'as' => 'users.delete',
        'uses' => 'UsersController@delete',
    ]);
});

// Back Office
// ===========
$router->group(['prefix' => 'back-office'], function () use ($router) {
    $router->get('', [
        'as' => 'back-office.dashboard',
        'uses' => 'BackOffice\DashboardController@index',
    ]);

    // Admins
    // ------
    $router->group(['prefix' => 'admins'], function () use ($router) {
        // LOGIN admin
        $router->get('login', [
            'as' => 'back-office.auth.create',
            'uses' => 'BackOffice\AuthController@create',
        ]);
        $router->post('login', [
            'as' => 'back-office.auth.login',
            'uses' => 'BackOffice\AuthController@login',
        ]);

        // LOGOUT admin
        $router->get('logout', [
            'as' => 'back-office.auth.logout',
            'uses' => 'BackOffice\AuthController@logout',
        ]);

        // READ admin
        $router->get('{adminId:[\d]+}', [
            'as' => 'back-office.admins.show',
            'uses' => 'BackOffice\AdminsController@show',
        ]);
    });
    // Pieces
    // ------
    $router->group(['prefix' => 'pieces'], function () use ($router) {
        // CREATE piece
        $router->get('create', [
            'as' => 'back-office.pieces.create',
            'uses' => 'BackOffice\PiecesController@create',
        ]);
        $router->post('store', [
            'as' => 'back-office.pieces.store',
            'uses' => 'BackOffice\PiecesController@store',
        ]);

        // READ piece(s)
        $router->get('', [
            'as' => 'back-office.pieces.index',
            'uses' => 'BackOffice\PiecesController@index',
        ]);
        $router->get('{pieceId:[\d]+}', [
            'as' => 'back-office.pieces.show',
            'uses' => 'BackOffice\PiecesController@show',
        ]);

        // UPDATE piece
        $router->get('{pieceId:[\d]+}/edit', [
            'as' => 'back-office.pieces.edit',
            'uses' => 'BackOffice\PiecesController@edit',
        ]);
        $router->post('{pieceId:[\d]+}', [
            'as' => 'back-office.pieces.update',
            'uses' => 'BackOffice\PiecesController@update',
        ]);

        // DELETE piece
        $router->get('{pieceId:[\d]+}/delete', [
            'as' => 'back-office.pieces.delete',
            'uses' => 'BackOffice\PiecesController@delete',
        ]);
    });
    // Outfits
    // -------
    $router->group(['prefix' => 'outfits'], function () use ($router) {
        // CREATE outfit
        $router->get('create', [
            'as' => 'back-office.outfits.create',
            'uses' => 'BackOffice\OutfitsController@create',
        ]);
        $router->post('store', [
            'as' => 'back-office.outfits.store',
            'uses' => 'BackOffice\OutfitsController@store',
        ]);

        // READ outfit(es)
        $router->get('', [
            'as' => 'back-office.outfits.index',
            'uses' => 'BackOffice\OutfitsController@index',
        ]);
        $router->get('{outfitId:[\d]+}', [
            'as' => 'back-office.outfits.show',
            'uses' => 'BackOffice\OutfitsController@show',
        ]);

        // UPDATE outfit
        $router->get('{outfitId:[\d]+}/edit', [
            'as' => 'back-office.outfits.edit',
            'uses' => 'BackOffice\OutfitsController@edit',
        ]);
        $router->post('{outfitId:[\d]+}', [
            'as' => 'back-office.outfits.update',
            'uses' => 'BackOffice\OutfitsController@update',
        ]);

        // DELETE outfit
        $router->get('{outfitId:[\d]+}/delete', [
            'as' => 'back-office.outfits.delete',
            'uses' => 'BackOffice\OutfitsController@delete',
        ]);
    });
});