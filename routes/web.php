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

Route::get('robots.txt', function ()
{
    if (App::environment() == 'production') {
        // If on the live server, serve a nice, welcoming robots.txt.
        Robots::addUserAgent('*');
        Robots::addSitemap('sitemap.xml');
        Robots::addDisallow('/backoffice');
    } else {
        // If you're on any other server, tell everyone to go away.
        Robots::addDisallow('*');
    }

    return Response::make(Robots::generate(), 200, ['Content-Type' => 'text/plain']);
});



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
    	Route::post('/subscribe', 'Frontend\HomepageController@subscribe')->name('frontend.subscribe');

    	Route::post('/rateservice', 'Frontend\HomepageController@rateService')->name('frontend.rateservice');

    	/** Categories And Products **/
    	Route::get('/categories', 'Frontend\CategoryController@index')->name('frontend.categories');
    	Route::get('/category/{slug}', 'Frontend\CategoryController@productlist')->name('frontend.productlist');
    	Route::get('/productsearch', 'Frontend\CategoryController@productlistSearch')->name('frontend.productlistsearch');

    	Route::get('/brand/{slug}', 'Frontend\CategoryController@productsByBrand')->name('frontend.productsByBrand');
    	Route::get('product/{slug}', 'Frontend\CategoryController@product')->name('frontend.product');



		

    	
    	/** Careers **/
    	Route::get('/careers', 'Frontend\CareerController@index')->name('frontend.careers');
    	Route::get('/careers/{slug}', 'Frontend\CareerController@job')->name('frontend.job');
    	Route::post('/careers/apply', 'Frontend\CareerController@postApplication')->name('frontend.applyjob');


    	/** Blog **/
       	Route::get('/blog','Frontend\BlogController@index')->name('frontend.blogs');
       	Route::get('/blog/category/{category}','Frontend\BlogController@categoryPosts')->name('frontend.postsbycategory');
       	Route::get('/blog/tag/{tag}','Frontend\BlogController@tagPosts')->name('frontend.posts-by-tag');
       	Route::get('/blog-post/{slug}','Frontend\BlogController@post')->name('frontend.post');
       	Route::post('/blog-post-comment/{post_id}','Frontend\BlogController@postComment')->name('frontend.post-comment');

       	/** News **/
       	Route::get('/news','Frontend\NewsController@index')->name('frontend.news');
       	Route::get('/news/{slug}','Frontend\NewsController@show')->name('frontend.news.show');

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

        /** Testimonials **/
        Route::get('/testimonials','Frontend\TestimonialController@show')->name('frontend.testimonials');

        /** Information Pages **/
        Route::get('/information/{slug}','Frontend\InformationController@show')->name('frontend.information');

        Route::post('/sendcomment','Frontend\CommentController@store')->name('frontend.comment');


		
		Route::get('/register', 'Frontend\signUpController@index')->name('frontend.register');
		Route::post('/register', 'Frontend\signUpController@postRegister')->name('frontend.signup');
		Route::get('/activate/{email}/{activationCode}','Frontend\ActivationController@index');
		
		Route::get('/login', 'Frontend\LoginController@index')->name('frontend.login');
		Route::post('/login', 'Frontend\LoginController@login')->name('frontend.login');
		Route::post('/logout', 'Frontend\LoginController@logout')->name('frontend.logout');
		Route::get('/forgot-password', 'Frontend\ForgotPasswordController@index')->name('frontend.forgot-password');


		Route::get('add-to-cart/{id}', 'Frontend\QuoteController@addToCart')->name('addToCart');
		Route::get('/removecartitem/{id}', 'Frontend\QuoteController@removeCartItem')->name('cart.removeCartItem');
		Route::post('/updatecartitem/{id}', 'Frontend\QuoteController@updateCartItem')->name('cart.updateCartItem');
		
		Route::get('/quoterequest', 'Frontend\QuoteController@index')->name('cart');
		Route::get('/sendquoterequest', 'Frontend\QuoteController@sendQuoteRequest')->name('send.quote');

		
		Route::get('/result', function(){
			return view('frontend.message');
		})->name('message');


		/*---Customer Account Middleware routes--*/
		
		Route::group(['middleware' =>'customer'], function(){
			Route::get('/my-account', 'Frontend\MyAccountController@index')->name('frontend.myaccount');
			Route::resource('myaccount/quotes','Frontend\MyAccount\QuotesController');
			Route::get('myaccount/quotes/download/{id}','Frontend\MyAccount\QuotesController@downloadPdf')->name('quotes.download');
			Route::resource('myaccount/myorders','Frontend\MyAccount\OrderController');
			Route::post('myaccount/makeOrder/{id}','Frontend\MyAccount\OrderController@createOrder')->name('myorders.makeOrder');
			Route::get('myaccount/myorders/orderfile/{fileid}/{file}','Frontend\MyAccount\OrderController@getOrderFile')->name('myorders.orderfile');

			Route::get('myaccount/myorders/orderShipmentfile/{fileid}/{file}','Frontend\MyAccount\OrderController@getOrderShipmentFile')->name('myorders.orderShipmentfile');

			Route::resource('myaccount/user','Frontend\MyAccount\UserController', ['only' => ['show','update']]);

			Route::resource('myaccount/rating','Frontend\MyAccount\RatingsController', ['only' => ['show','update']]);
			Route::post('myaccount/rating2/{rating}', 'Frontend\MyAccount\RatingsController@update2')->name('rating.update2');
			
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

	Route::group(['middleware' =>'super-admin'], function(){

		


		///////*****User Management********//////
		Route::get('user/register', 'Backend\User\RegisterController@index');
		Route::post('user/register', 'Backend\User\RegisterController@postRegister');
		Route::get('user/users', 'Backend\User\UserController@index')->name('users.index');
		Route::get('user/edit/{id}', 'Backend\User\UserController@edit')->name('users.edit');
		Route::post('user/update/{id}', 'Backend\User\UserController@update')->name('users.update');

		///////*****Customers********//////
		Route::resource('customers/customers','Backend\Customer\CustomerController');
		

});

		Route::group(['middleware' =>'admin'], function(){

			///////*****Pages********//////
		Route::resource('pages','Backend\Page\PageController');
		Route::get('pages/create/{id}', 'Backend\Page\PageController@create')->name('pages.create');
		Route::post('pages/store/{id}', 'Backend\Page\PageController@store')->name('pages.store');
		Route::post('pages/status/{id}', 'Backend\Page\PageController@status')->name('pages.status');
		/*Route::post('pages/delete/{id}', 'Backend\Page\PageController@destroy')->name('pages.delete');
*/

		Route::resource('webpages','Backend\Page\WebPageController');

		///////*****Blog********//////
		Route::resource('blog/posts','Backend\Blog\PostController');
		Route::resource('blog/blogcategory','Backend\Blog\BlogCategoryController');
		Route::resource('blog/tags','Backend\Blog\TagController');
		Route::delete('blog/post-comment/delete/{postCommentId}','Backend\Blog\PostController@deletePostComment')->name('delete-post-comment');

		///////*****Product********//////
		Route::resource('catalog/products','Backend\Product\ProductController');
		Route::post('products/discontinue/{id}','Backend\Product\ProductController@discontinue')->name('products.discontinue');
		Route::post('products/featured/{id}','Backend\Product\ProductController@featured')->name('products.featured');
		Route::get('products/search','Backend\Product\ProductController@productSearch')->name('products.search');

		
		Route::resource('catalog/brands','Backend\Product\BrandController');
		Route::resource('catalog/categories','Backend\Product\CategoryController');
		Route::resource('files','Backend\Product\FileController');
		Route::resource('images','Backend\Product\ImageController', ['only' => ['store','destroy']]);

		
		///////*****Comapny********//////
		Route::resource('module/company','Backend\Company\CompanyController');

		///////*****Department********//////
		Route::resource('module/departments','Backend\Department\DepartmentController', ['except' => ['show','create']]);

		///////*****Jobs********//////
		Route::resource('module/jobs','Backend\Careers\JobController');
		Route::get('module/jobs/getresume/{applicationId}','Backend\Careers\JobController@getResume')->name('job.getresume');
		Route::delete('module/jobs/deleteapplication/{applicationId}','Backend\Careers\JobController@deleteApplication')->name('job.deleteapplication');


		///////*****Testimonials********//////
		Route::resource('module/testimonials','Backend\Testimonial\TestimonialController');

		///////*****Team Members********//////
		Route::resource('module/members','Backend\Team\MemberController');

		///////*****Blocks********//////
		Route::resource('pages/blocks','Backend\Block\BlockController');

		

		///////*****Services********//////
		Route::resource('module/services','Backend\Services\ServiceController');

		///////*****News********//////
		Route::resource('module/news','Backend\News\NewsController');

		///////*****News********//////
		Route::resource('module/informations','Backend\Information\InformationController');

		///////*****Photos********//////
		Route::resource('photos','Backend\News\PhotoController', ['only' => ['store','destroy']]);

		///////*****Contact********//////
		Route::resource('module/locations','Backend\Location\LocationController');

		///////*****Comments********//////
		Route::get('module/comments','Backend\Comments\CommentController@index')->name('comments.index');
		Route::get('module/comments/{id}','Backend\Comments\CommentController@show')->name('comments.show');
		Route::delete('module/comments/{id}','Backend\Comments\CommentController@destroy')->name('comments.destroy');


		 Route::get('module/ratings','Backend\Ratings\RatingController@index')->name('ratings.index');
		
		Route::get('module/subscribers','Backend\Newsletter\SubscriberController@index')->name('subscribers.index');
		
	});

	

	///////*****Email testing********//////
		Route::get('sendNotification', 'Backend\Notification\NotificationController@send')->name('sendNotification');

		Route::get('notifications', 'Backend\Notification\NotificationController@index')->name('notifications.index');
		Route::get('notifications/{id}', 'Backend\Notification\NotificationController@markAsRead')->name('notifications.markasread');
		Route::get('markallasread', 'Backend\Notification\NotificationController@markAllAsRead')->name('notifications.markallasread');
		Route::get('allnotifications', 'Backend\Notification\NotificationController@allNotifications')->name('notifications.allnotifications');
		Route::get('delnotifications', 'Backend\Notification\NotificationController@delete')->name('notifications.delete');


	///////*****Quotes********//////
	Route::resource('quotes/quote-requests','Backend\Quotes\QuoteController');
	Route::get('quotes/download/{id}','Backend\Quotes\QuoteController@downloadPdf')->name('quote-requests.download');

	///////*****Orders********//////
	Route::resource('orders','Backend\Order\OrderController');
	Route::get('orders/orderfile/{fileid}/{file}','Backend\Order\OrderController@getOrderFile')->name('orders.orderfile');
	Route::get('orders/orderShipmentfile/{fileid}/{file}','Backend\Order\OrderController@getOrderShipmentFile')->name('orders.orderShipmentfile');

	Route::get('user/profile', 'Backend\User\UserController@show')->name('users.show');
	Route::post('user/profile/changepasword', 'Backend\User\UserController@changePassword')->name('users.changepassword');
	Route::post('user/addpicture', 'Backend\User\UserController@addPicture')->name('users.addpicture');
	Route::get('user/getprofilepicture/{file}','Backend\User\UserController@getProfilePicture')->name('users.getprofilepicture');

});



