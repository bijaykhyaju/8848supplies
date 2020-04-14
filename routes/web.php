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

/*
|--------------------------------------------------------------------------
| Admin panel Web Routes
|--------------------------------------------------------------------------

*/

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//get image route
Route::get('image/{filename}', 'HomeController@displayImage')->name('image.displayImage');

//Route for Categories page

Route::get('/categories', 'CategoryController@index');

Route::get('/categories/add', 'CategoryController@addEditCatPage');

Route::post('/categories/insert', 'CategoryController@store');

Route::post('/categories/delete', 'CategoryController@destroy');

Route::get('/categories/edit/{id}', 'CategoryController@addEditCatPage');


//Route for Products Page

Route::get('/product-category', 'ProductController@index');

Route::get('/products/{id}', 'ProductController@productsByCategory');

Route::get('/products/add/{catId}', 'ProductController@addEditProductPage');

Route::post('/products/insert', 'ProductController@store');

Route::get('/product/edit/{id}', 'ProductController@addEditProductPage');

Route::post('/product/delete', 'ProductController@destroy');

Route::post('/product/publish', 'ProductController@publish');

Route::get('/admin/about', 'PagesController@aboutPage');

Route::post('/admin/about-update', 'PagesController@aboutUpdate');





/*
|--------------------------------------------------------------------------
| Front-end Web Routes
|--------------------------------------------------------------------------

*/
Route::get('/', 'FrontendController@frontIndexPage');
Route::get('/index','FrontendController@frontIndexPage');

Route::post('/product/add-to-cart','FrontendController@addToCart');
Route::post('/add-item','FrontendController@addToCart');

Route::get('/product/{alias}','FrontendController@productDetailPage');

Route::get('/products','FrontendController@allProductsPage');


Route::get('/cart','FrontendController@cartPage');
Route::post('/cart-update','FrontendController@cartUpdate');
Route::post('/cart-delete','FrontendController@cartDelete');


Route::get('/category','FrontendController@frontCategoryPage');
Route::get('/category/{alias}','FrontendController@productByCategoryPage');

Route::get('/correspondence-detail','FrontendController@correspondencePage');
Route::post('/correspondence-submit','FrontendController@correspondenceSubmit');
Route::get('/detail-confirmation','FrontendController@correspondenceDetailConfirmation');
Route::get('/order-summary','FrontendController@orderSummaryPage');
Route::get('/contact', 'FrontendController@contactPage');
Route::get('/about', 'FrontendController@aboutPage');

Route::post('/subscribe-newsletter','FrontendController@newsletterSubscribe');


/*
|--------------------------------------------------------------------------
| Paypal payment Routes
|--------------------------------------------------------------------------
*/
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');

/*
|--------------------------------------------------------------------------
| Send Email Route
|--------------------------------------------------------------------------
*/
Route::get('/purchase-success/{sales_id}','MailSendController@mailsend');