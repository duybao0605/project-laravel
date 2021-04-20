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

// composer install --ignore-platform-reqs




Route::group([
	'namespace' => 'frontend',
], function (){
	//blog
    Route::get('blog/list','BlogController@list');
    Route::get('blog/detail/{id}','BlogController@showDetail');



    Route::group(['middleware' => 'member'], function () {

    	//check if not loggin
	    //signup
	    Route::get('log','LoginController@show2');
	    Route::post('log','LoginController@login2');
	    //login
	    Route::get('signup','LoginController@show');
	    Route::post('signup','LoginController@create');
	    


	    //account
	    Route::get('account/{id}','AccountController@show');
	    Route::post('account/{id}','AccountController@edit');
	    //comment
	    Route::get('comment/{id}','CommentController@showComment');
	    Route::post('comment/{id}', 'CommentController@postComment');
	    //rate
	    Route::post('ajax/rate','RateController@rate');
	    //product
	    Route::get('product/list','ProductController@show');
		    //add
		    Route::get('product/add','ProductController@showForm');
		    Route::post('product/add','ProductController@add');
		    //edit
		    Route::get('product/edit/{id}','ProductController@edit');
		    Route::post('product/edit/{id}','ProductController@update');
		    //delete
		    Route::get('product/delete/{id}','ProductController@delete');


		Route::get('product/detail/{id}','ProductController@detail');	


		Route::post('add-Cart','ProductController@addCart');	

		Route::get('cart','ProductController@showCart');
		Route::post('cart','ProductController@cart');

		Route::get('sendmail','ProductController@sendMail');

	});
	

	Route::get('index','ProductController@getProducts');
	Route::match(['get', 'post'], 'search','ProductController@search');
	Route::match(['get', 'post'], 'search_ad','ProductController@search_ad');
	Route::post('price_rage','ProductController@priceRage');

	//logout
	Route::get('logout', 'LoginController@logout2');






	
});

// Route::get('/demo', 'DemoController@index')->name('demo');

//vao admin (Be)
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/', 'LoginController@showLoginForm');
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');
});
Route::group([
	'prefix' => 'admin',
	'namespace' => 'admin',
	'middleware' => ['admin'],

], function (){
	//admin
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/profile', 'UserController@show');
	Route::get('/blog','BlogController@index');
	//profile
	Route::post('/profile','UserController@edit');
	//country
	Route::get('/country/list','CountryController@index');
	Route::get('/country/add','CountryController@add');
	Route::post('/country/add','CountryController@insert');
	Route::get('/country/delete','CountryController@delete');
	//brand
	Route::get('/brand/list','BrandController@index');
	Route::get('/brand/add','BrandController@add');
	Route::post('/brand/add','BrandController@insert');
	Route::get('/brand/delete','BrandController@delete');
	//category
	Route::get('/category/list','CategoryController@index');
	Route::get('/category/add','CategoryController@add');
	Route::post('/category/add','CategoryController@insert');
	Route::get('/category/delete','CategoryController@delete');
	//blog
	Route::get('/blog/list','BlogController@index');
	Route::get('/blog/add','BlogController@add');
	Route::post('/blog/add','BlogController@insert');

	Route::get('/blog/edit/{id}','BlogController@edit');
	Route::post('/blog/edit/{id}','BlogController@update');

	Route::get('/blog/delete/{id}','BlogController@delete');
});

