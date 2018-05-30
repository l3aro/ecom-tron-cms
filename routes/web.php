<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Frontend Zone
 */
Route::group([
    'namespace' => 'Frontend'
], function() {
    Route::get('/', [
        'as' => 'frontend.homepage',
        'uses' => 'HomeController@show'
    ]);

    /**
     * Contact routes
     */
    Route::group([
        'prefix' => 'contact'
    ], function() {
        Route::get('/', [
            'as' => 'frontend.contact.show',
            'uses' => 'ContactController@show'
        ]);
    });

    /**
     * Login routes
     */
    Route::group([
        'prefix' => 'login'
    ], function() {
        Route::get('/', [
            'as' => 'frontend.login.show',
            'uses' => 'LoginController@show'
        ]);
    });

    /**
     * Order routes
     */
    Route::group([
        'prefix' => 'cart'
    ], function() {
        Route::get('/', [
            'as' => 'frontend.order.show',
            'uses' => 'OrderController@show'
        ]);
    });

    /**
     * Product Category routes
     */
    Route::group([
        'prefix' => 'product-cat'
    ], function() {
        Route::get('/', [
            'as' => 'frontend.productcat.show',
            'uses' => 'ProductCatController@show'
        ]);
    });

    /**
     * Product routes
     */
    Route::group([
        'prefix' => 'product'
    ], function() {
        Route::get('/', [
            'as' => 'frontend.product.show',
            'uses' => 'ProductController@show'
        ]);
    });
});

/**
 * Admin Zone
 */
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function() {
    Route::group([
        'middleware' => 'auth.admin.unauthenticated'
    ], function() {
        //Login routes
        Route::get('login', [
            'as' => 'admin.showLoginForm',
            'uses' => 'LoginController@showLoginForm'
        ]);
        Route::post('login', [
            'as' => 'admin.login',
            'uses' => 'LoginController@login'
        ]);
    });

    Route::group([
        'middleware' => 'auth.admin.authenticated'
    ], function() {
        Route::post('logout', [
            'as' => 'admin.logout',
            'uses' => 'LoginController@logout'
        ]);

        Route::get('/', [
            'as' => 'admin.dashboard',
            'uses' => 'HomeController@dashboard'
        ]);

        /**
         * Article routes
         */
        Route::group([
            'prefix' => 'article'
        ], function() {
            Route::get('/', [
                'as' => 'admin.article.index',
                'uses' => 'ArticleController@index'
            ]);
            Route::match(['get', 'post'], 'detail', [
                'as' => 'admin.article.detail',
                'uses' => 'ArticleController@detail'
            ]);
            Route::get('changefield', [
                'as' => 'admin.article.changefield',
                'uses' => 'ArticleController@changefield'
            ]);
            Route::get('delete', [
                'as' => 'admin.article.delete',
                'uses' => 'ArticleController@delete'
            ]);
        });
    });
});