<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
////////////////////////*FRONTEND ROUTES*////////////////////////////////////////
 Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
    ],
    function()
    {

        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    	Route::get('/', 'Frontend\HomepageController@index');

    	/** Categories And Products **/
    	Route::get('/categories', 'Frontend\CategoryController@index')->name('frontend.categories');
    	Route::get('/category/{slug}', 'Frontend\CategoryController@productlist')->name('frontend.productlist');
    	Route::get('product/{slug}', 'Frontend\CategoryController@product')->name('frontend.product');


		

    	
    	/** Careers **/
    	Route::get('/careers', 'Frontend\CareerController@index')->name('frontend.careers');
    	Route::get('/careers/{slug}', 'Frontend\CareerController@job')->name('frontend.job');

    	/** Blog **/
       	Route::get('/blog','Frontend\BlogController@index')->name('frontend.blogs');
       	Route::get('/blog/category/{category}','Frontend\BlogController@categoryPosts')->name('frontend.posts-by-category');
       	Route::get('/blog/tag/{tag}','Frontend\BlogController@tagPosts')->name('frontend.posts-by-tag');
       	Route::get('/blog-post/{slug}','Frontend\BlogController@post')->name('frontend.post');

       	/** News **/
       	Route::get('/news','Frontend\NewsController@index')->name('frontend.news');
       	Route::get('/news/{id}','Frontend\NewsController@show')->name('frontend.news.show');

       	/** services **/
       	Route::get('/service/{slug}','Frontend\ServiceController@show')->name('frontend.services');

       	/** Who we are **/
        Route::get('/about','Frontend\AboutController@show')->name('frontend.about');

        /** Industry **/
        Route::get('/industry','Frontend\IndustryController@show')->name('frontend.industry');

        /** Mission **/
        Route::get('/mission','Frontend\MissionController@show')->name('frontend.mission');

        /** Approach **/
        Route::get('/approach','Frontend\ApproachController@show')->name('frontend.approach');

        /** Our Team **/
        Route::get('/team','Frontend\TeamController@show')->name('frontend.team');

        /** Contact **/
        Route::get('/contact','Frontend\ContactController@show')->name('frontend.contact');
		
		
		Route::get('/register', 'Frontend\signUpController@index')->name('frontend.register');
		Route::post('/register', 'Frontend\signUpController@postRegister')->name('frontend.signup');
		Route::get('/activate/{email}/{activationCode}','Frontend\ActivationController@index');
		
		Route::get('/login', 'Frontend\LoginController@index')->name('frontend.login');
		Route::post('/login', 'Frontend\LoginController@login')->name('frontend.login');
		Route::post('/logout', 'Frontend\LoginController@logout')->name('frontend.logout');
		Route::get('/forgot-password', 'Frontend\ForgotPasswordController@index')->name('frontend.forgot-password');


		Route::get('add-to-cart/{id}', 'Frontend\QuoteController@addToCart')->name('addToCart');
		Route::get('/cart', 'Frontend\QuoteController@index')->name('cart');
		Route::post('/update-cart-qty/{id}', 'Frontend\QuoteController@updateCart')->name('updateCart');
		Route::get('/cart/{step}', 'Frontend\QuoteController@confirmCart')->name('cart.step');
		Route::post('/cart/{step}', 'Frontend\QuoteController@postConfirmCart')->name('cart.step');
		Route::get('/send-quote', 'Frontend\QuoteController@sendQuote')->name('send.quote');
		
		Route::get('/result', function(){
			return view('frontend.message');
		})->name('message');
		
		Route::group(['middleware' =>'customer'], function(){
		
		Route::get('/my-account', 'Frontend\MyAccountController@index')->name('frontend.myaccount');
			
		Route::resource('myaccount/quotes','Frontend\MyAccount\QuotesController'
				);
			
			
		});

		

		});




Route::get('backoffice/login', 'Backend\User\LoginController@index');
Route::post('backoffice/login', 'Backend\User\LoginController@postLogin');
Route::post('backoffice/logout', 'Backend\User\LoginController@logout');
Route::get('backoffice/forgot-password', 'Backend\User\ForgotPasswordController@show')->name('forgot-password');
Route::post('backoffice/forgot-password', 'Backend\User\ForgotPasswordController@sendCode')->name('forgot-password');
Route::get('/reset/{email}/{resetCode}', 'Backend\User\ForgotPasswordController@reset');
Route::post('/reset/{email}/{resetCode}', 'Backend\User\ForgotPasswordController@resetPassword');
Route::post('language/{id}', 'Language\languageController@change')->name('language.change') ;



////////////////////////*BACKEND ROUTES*////////////////////////////////////////

Route::group(['prefix' =>'backoffice', 'middleware' =>'backend'], function(){

	///////*****Dashboard********//////
	Route::get('/','Backend\DashboardController@index');

	///////*****User Management********//////
	Route::get('user/register', 'Backend\User\RegisterController@index');
	Route::post('user/register', 'Backend\User\RegisterController@postRegister');
	Route::get('user/users', 'Backend\User\UserController@index')->name('users.index');
	Route::get('user/edit/{id}', 'Backend\User\UserController@edit')->name('users.edit');
	Route::post('user/update/{id}', 'Backend\User\UserController@update')->name('users.update');

	
	///////*****Pages********//////
	Route::resource('pages','Backend\Page\PageController');
	Route::get('pages/create/{id}', 'Backend\Page\PageController@create')->name('pages.create');
	Route::post('pages/store/{id}', 'Backend\Page\PageController@store')->name('pages.store');
	Route::post('pages/status/{id}', 'Backend\Page\PageController@status')->name('pages.status');



	///////*****Blog********//////
	Route::resource('blog/posts','Backend\Blog\PostController');
	Route::resource('blog/blogcategory','Backend\Blog\BlogCategoryController');
	Route::resource('blog/tags','Backend\Blog\TagController');

	///////*****Product********//////
	Route::resource('catalog/products','Backend\Product\ProductController');
	Route::post('products/discontinue/{id}','Backend\Product\ProductController@discontinue')->name('products.discontinue');
	Route::post('products/featured/{id}','Backend\Product\ProductController@featured')->name('products.featured');
	
	Route::resource('catalog/brands','Backend\Product\BrandController');
	Route::resource('catalog/categories','Backend\Product\CategoryController');
	Route::resource('files','Backend\Product\FileController', ['only' => ['store','destroy']]);
	Route::resource('images','Backend\Product\ImageController', ['only' => ['store','destroy']]);

	
	///////*****Department********//////
	Route::resource('module/departments','Backend\Department\DepartmentController', ['except' => ['show','create']]);

	///////*****Jobs********//////
	Route::resource('module/jobs','Backend\Careers\JobController');

	///////*****Testimonials********//////
	Route::resource('module/testimonials','Backend\Testimonial\TestimonialController');

	///////*****Team Members********//////
	Route::resource('module/members','Backend\Team\MemberController');

	///////*****Blocks********//////
	Route::resource('pages/blocks','Backend\Block\BlockController');

	///////*****Customers********//////
	Route::resource('customers/customers','Backend\Customer\CustomerController');

	///////*****Services********//////
	Route::resource('module/services','Backend\Services\ServiceController');

	///////*****News********//////
	Route::resource('module/news','Backend\News\NewsController');

	///////*****Photos********//////
	Route::resource('photos','Backend\News\PhotoController', ['only' => ['store','destroy']]);

	///////*****Contact********//////
	Route::resource('module/locations','Backend\Location\LocationController');

	///////*****Contact********//////
	Route::resource('quotes/quote-requests','Backend\Quotes\QuoteController');
});

