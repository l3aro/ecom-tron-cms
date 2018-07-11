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
        'prefix' => 'lien-he'
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
        'prefix' => 'gio-hang'
    ], function() {
        Route::get('/', [
            'as' => 'frontend.order.show',
            'uses' => 'OrderController@show'
        ]);
        Route::post('them', [
            'as' => 'frontend.order.add',
            'uses' => 'OrderController@add'
        ]);
        Route::get('details', [
            'as' => 'frontend.order.details',
            'uses' => 'OrderController@details'
        ]);
        Route::post('delete', [
            'as' => 'frontend.order.delete',
            'uses' => 'OrderController@delete'
        ]);
        Route::post('update', [
            'as' => 'frontend.order.update',
            'uses' => 'OrderController@update'
        ]);
        Route::get('kiem-tra', [
            'as' => 'frontend.order.checkout',
            'uses' => 'OrderController@checkout'
        ]);
        Route::post('store', [
            'as' => 'frontend.order.store',
            'uses' => 'OrderController@store'
        ]);
    });

    /**
     * Search routes
     */
    Route::group([
        'prefix' => 'tim-kiem'
    ], function() {
        Route::get('{keyword?}', [
            'as' => 'frontend.search.show',
            'uses' => 'SearchController@show'
        ]);
    });

    /**
     * Category routes
     */
    Route::group([
        'prefix' => '{category}'
    ], function($category) {
        $segment = Request::segment(1);
        if ($segment == 'hang-moi-ve'||$segment == 'khuyen-mai') {
            Route::get('/', [
                'as' => 'frontend.productcat.show',
                'uses' => 'ProductCatController@show'
            ]);
        }
        else if ($segment == 'articles') {
            Route::get('/', [
                'as' => 'frontend.articlecat.show',
                'uses' => 'ArticleCatController@show'
            ]);
        }
        else if ($segment == 'danh-muc-san-pham') {
            Route::get('/', [
                'as' => 'frontend.productcat.show',
                'uses' => 'ProductCatController@show'
            ]);
        }
        else {
            $type = App\Models\Category::where('slug',$segment)->first();
            if ($type) {
                if ($type->type==0) {
                    Route::get('/', [
                        'as' => 'frontend.articlecat.show',
                        'uses' => 'ArticleCatController@show'
                    ]);
                }
                else if ($type->type==1) {
                    Route::get('/', [
                        'as' => 'frontend.productcat.show',
                        'uses' => 'ProductCatController@show'
                    ]);
                }
            }
        }
    });

    /**
     * Product routes
     */
    Route::group([
        'prefix' => 'san-pham'
    ], function() {
        Route::get('{item}', [
            'as' => 'frontend.product.show',
            'uses' => 'ProductController@show'
        ]);
    });

    
    
    // if ( $type == 'user' ) {
    //     Route::get('/{username}', 'UserController@view');
    // } else {
    //     Route::get('/{slug}', 'PageController@view');
    // }
    // Route::get('{category}', function($category) {
    //     if ($category == '1') {
    //         return redirect()->action('Frontend\ProductCatController@show');
    //     }
    //     else {
    //         return redirect()->action('Frontend\ProductController@show');
    //     }
    // });

    // /**
    //  * Product Category routes
    //  */
    // Route::group([
        
    // ], function() {
    //     Route::get('/', [
    //         'as' => 'frontend.productcat.show',
    //         'uses' => 'ProductCatController@show'
    //     ]);
    // });

    // /**
    //  * Product routes
    //  */
    // Route::group([
    //     'prefix' => 'product'
    // ], function() {
    //     Route::get('/', [
    //         'as' => 'frontend.product.show',
    //         'uses' => 'ProductController@show'
    //     ]);
    // });
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

        /**
         * Article Category routes
         */
        Route::group([
            'prefix' => 'article-cat'
        ], function() {
            Route::get('/', [
                'as' => 'admin.article-cat.index',
                'uses' => 'ArticleCatController@index'
            ]);
            Route::match(['get', 'post'], 'detail', [
                'as' => 'admin.article-cat.detail',
                'uses' => 'ArticleCatController@detail'
            ]);
            Route::get('delete', [
                'as' => 'admin.article-cat.delete',
                'uses' => 'ArticleCatController@delete'
            ]);
        });

        /**
         * Product routes
         */
        Route::group([
            'prefix' => 'product'
        ], function() {
            Route::get('/', [
                'as' => 'admin.product.index',
                'uses' => 'ProductController@index'
            ]);
            Route::match(['get', 'post'], 'detail', [
                'as' => 'admin.product.detail',
                'uses' => 'ProductController@detail'
            ]);
            Route::get('changefield', [
                'as' => 'admin.product.changefield',
                'uses' => 'ProductController@changefield'
            ]);
            Route::get('delete', [
                'as' => 'admin.product.delete',
                'uses' => 'ProductController@delete'
            ]);
            Route::get('deleteavatar',[
                'as' => 'admin.product.deleteavatar',
                'uses' => 'ProductController@deleteavatar',
            ]);
            Route::get('deleteproductimage',[
                'as' => 'admin.product.deleteproductimage',
                'uses' => 'ProductController@deleteproductimage',
            ]);
            Route::post('uploadimage',[
                'as' => 'admin.product.uploadimage',
                'uses' => 'ProductController@uploadImage',
            ]);
        });
        
        /**
         * Product Category routes
         */
        Route::group([
            'prefix' => 'product-cat'
        ], function() {
            Route::get('/', [
                'as' => 'admin.product-cat.index',
                'uses' => 'ProductCatController@index'
            ]);
            Route::match(['get', 'post'], 'detail', [
                'as' => 'admin.product-cat.detail',
                'uses' => 'ProductCatController@detail'
            ]);
            Route::get('delete', [
                'as' => 'admin.product-cat.delete',
                'uses' => 'ProductCatController@delete'
            ]);
        });

        /**
         * Profile routes
         */
        Route::group([
            'prefix' => 'profile',
        ], function() {
            Route::match(['get', 'post'], 'info', [
                'as' => 'admin.profile.info',
                'uses' => 'UserController@info'
            ]);
            Route::match(['get', 'post'], 'password', [
                'as' => 'admin.profile.password',
                'uses' => 'UserController@changePassword'
            ]);
        });

        /**
         * User routes
         */
        Route::group([
            'prefix' => 'user',
        ], function() {
            Route::get('list-admin', [
                'as' => 'admin.user.list-admin',
                'uses' => 'UserController@listAdmin'
            ]);
            Route::get('list-customer', [
                'as' => 'admin.user.list-customer',
                'uses' => 'UserController@listCustomer'
            ]);
            Route::match(['get', 'post'], 'detail', [
                'as' => 'admin.user.detail',
                'uses' => 'UserController@detail'
            ]);
            Route::get('changefield', [
                'as' => 'admin.user.changefield',
                'uses' => 'UserController@changefield'
            ]);
        });

        /**
         * Menu Category routes
         */
        Route::group([
            'prefix' => 'menu-cat'
        ], function() {
            Route::get('/', [
                'as' => 'admin.menu-cat.index',
                'uses' => 'MenuCatController@index'
            ]);
            Route::match(['get', 'post'], 'detail', [
                'as' => 'admin.menu-cat.detail',
                'uses' => 'MenuCatController@detail'
            ]);
            Route::get('delete', [
                'as' => 'admin.menu-cat.delete',
                'uses' => 'MenuCatController@delete'
            ]);
        });

        /**
         * Menu routes
         */
        Route::group([
            'prefix' => 'menu'
        ], function() {
            Route::get('/',[
                'as' => 'admin.menu.index',
                'uses' => 'MenuController@index',
            ]);
            Route::match(['get','post'],'detail',[
                'as' => 'admin.menu.detail',
                'uses' => 'MenuController@detail',
            ]);
            Route::get('delete/{id}',[
                'as' => 'admin.menu.delete',
                'uses' => 'MenuController@delete',
            ]);
            Route::get('list_products',[
                'as' => 'admin.menu.list_products',
                'uses' => 'MenuController@list_products',
            ]);
            Route::get('list_articles',[
                'as' => 'admin.menu.list_articles',
                'uses' => 'MenuController@list_articles',
            ]);
            Route::get('get_product',[
                'as' => 'admin.menu.get_product',
                'uses' => 'MenuController@get_product',
            ]);
            Route::get('get_article',[
                'as' => 'admin.menu.get_article',
                'uses' => 'MenuController@get_article',
            ]);
            Route::post('sortcat',[
                'as' => 'admin.menu.sortcat',
                'uses' => 'MenuController@sortcat',
            ]);
            Route::get('delete', [
                'as' => 'admin.menu.delete',
                'uses' => 'MenuController@delete'
            ]);
        });

        /**
         * Order routes
         */
        Route::group([
            'prefix' => 'order'
        ], function() {
            Route::get('/', [
                'as' => 'admin.order.index',
                'uses' => 'OrderController@index'
            ]);
            Route::match(['get', 'post'], 'detail', [
                'as' => 'admin.order.detail',
                'uses' => 'OrderController@detail'
            ]);
            Route::get('changefield', [
                'as' => 'admin.order.changefield',
                'uses' => 'OrderController@changefield'
            ]);
            Route::get('delete', [
                'as' => 'admin.order.delete',
                'uses' => 'OrderController@delete'
            ]);
        });

    });
});