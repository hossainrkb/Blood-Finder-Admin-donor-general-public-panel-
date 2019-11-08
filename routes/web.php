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



//Admin Route
Route::group(['prefix' => 'admin'], function(){
  Route::get('/', 'backend\PageController@index')->name('admin');
  Route::post('/search', 'backend\PageController@search')->name('admin.search');
  Route::post('/update/{id}', 'backend\PageController@update')->name('admin.pass.update');

    // Registration Route
  
    Route::get('/register', 'Auth\admin\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\admin\RegisterController@register')->name('admin.submit.register');
  // Verification Route
    Route::get('/token/{token}', 'backend\VerificationController@verify')->name('admin.verification');
    //Admin login
    Route::get('/login', 'Auth\admin\LoginController@showLoginForm')->name('admin.login');
      Route::post('/login/submit', 'Auth\admin\LoginController@login')->name('admin.login.submit');
  Route::post('/logout', 'Auth\admin\LoginController@logout')->name('admin.logout');
  //Forgot PASSWORD (Email send)
  Route::get('/password/reset', 'Auth\admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/resetPost', 'Auth\admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  //Forgot PASSWORD (Reset)
  Route::get('/password/reset/{token}', 'Auth\admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
  Route::post('/password/reset', 'Auth\admin\ResetPasswordController@reset')->name('admin.password.update');




  // Donor Route
  Route::group(['prefix' => '/donor'], function(){
    Route::get('/', 'backend\DonorController@index')->name('admin.donor');
    Route::get('/create', 'backend\DonorController@create')->name('admin.donor.create');
    Route::post('/store', 'backend\DonorController@store')->name('admin.donor.store');
    Route::get('/edit/{id}', 'backend\DonorController@edit')->name('admin.donor.edit');
    Route::post('/edit/{id}', 'backend\DonorController@update')->name('admin.donor.update');
    Route::post('/destroy/{id}', 'backend\DonorController@destroy')->name('admin.donor.delete');
    Route::get('/details/{id}', 'backend\DonorController@details')->name('admin.donor.details');
    Route::post('/dp/{id}', 'backend\DonorController@dp')->name('admin.donor.dp');
      Route::get('/verify', 'backend\DonorController@showVerificationForm')->name('admin.donor.register.code');
    Route::post('/verify', 'backend\DonorController@verify')->name('admin.donor.store.code.verify');
    });
  // Slider Route
  Route::group(['prefix' => '/slider'], function(){
    Route::get('/', 'backend\SliderController@index')->name('admin.slider');
    Route::get('/create', 'backend\SliderController@create')->name('admin.slider.create');
    Route::post('/store', 'backend\SliderController@store')->name('admin.slider.store');
    Route::post('/destroy/{id}', 'backend\SliderController@destroy')->name('admin.slider.delete');
 
    });
    // Blood Stock Route
  Route::group(['prefix' => '/stock'], function(){
    Route::get('/', 'backend\BloodStockController@index')->name('admin.stock');
    Route::get('/create', 'backend\BloodStockController@create')->name('admin.stock.create');
    Route::post('/store', 'backend\BloodStockController@store')->name('admin.stock.store');
    Route::post('/edit/{id}', 'backend\BloodStockController@update')->name('admin.stock.update');
    Route::post('/destroy/{id}', 'backend\BloodStockController@destroy')->name('admin.stock.delete');
    //Route::get('/details/{id}', 'backend\DonorController@details')->name('admin.donor.details');
   //Route::post('/dp/{id}', 'backend\DonorController@dp')->name('admin.donor.dp');
    });
       // Donate Route
  Route::group(['prefix' => '/donate'], function(){
    Route::get('/', 'backend\BloodDonateLogController@index')->name('admin.donate.log');
    Route::get('/create', 'backend\BloodDonateController@create')->name('admin.donate.create');
    Route::post('/store', 'backend\BloodDonateController@store_donate')->name('admin.donate.store_donate');
    Route::post('/store/{id}', 'backend\BloodDonateController@update_donate')->name('admin.donate.update_donate');
   // Route::post('/destroy/{id}', 'backend\BloodStockController@destroy')->name('admin.stock.delete');
    //Route::get('/details/{id}', 'backend\DonorController@details')->name('admin.donor.details');
   //Route::post('/dp/{id}', 'backend\DonorController@dp')->name('admin.donor.dp');
    });



  });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/laravel_google_chart', 'LaravelGoogleGraph@index');
Route::get('/view', 'LaravelGoogleGraph@stat');
Route::get('/admin_details', function () {
   return view('backend.pages.admin_details');
});





//Donor  panelRoute
Route::group(['prefix' => 'donor'], function () {
  Route::get('/', 'donorpanel\PageController@index')->name('donor');
  Route::get('/request_list', 'donorpanel\DonorController@index')->name('donor.request');
  Route::get('/details', 'donorpanel\DonorController@details')->name('donor.details');
  Route::post('/dp/{id}', 'donorpanel\DonorController@dp')->name('donor.dp');
  Route::get('/edit/{id}', 'donorpanel\DonorController@edit')->name('donor.edit');
  Route::post('/edit/{id}', 'donorpanel\DonorController@update')->name('donor.update');
  Route::post('/update/{id}', 'donorpanel\DonorController@pass_up')->name('donor.pass.update');
  //blood donate
  Route::get('/donate_create', 'donorpanel\BloodDonateController@create')->name('donor.donate.create');
  Route::post('/store', 'donorpanel\BloodDonateController@store_donate')->name('donor.donate.store_donate');
  Route::post('/store/{id}', 'donorpanel\BloodDonateController@update_donate')->name('donor.donate.update_donate');
  //password reset
  Route::get('/password/reset', 'donorpanel\ForgotPasswordController@showLinkRequestForm')->name('donor.password.request');
  Route::post('/password/resetPost', 'donorpanel\ForgotPasswordController@sendResetLinkEmail')->name('donor.password.email');
  Route::get('/password/reset/{token}', 'donorpanel\ResetPasswordController@showResetForm')->name('donor.password.reset');
  Route::post('/password/reset', 'donorpanel\ResetPasswordController@reset')->name('donor.password.update');
  //blood request details
  Route::get('/request_details/{phone}', 'donorpanel\DonorController@request_details')->name('mango.request_details');
  Route::post('/logout', 'donorpanel\LoginController@logout')->name('donor.logout');
  // Donor Route
  Route::group(['prefix' => '/login'], function () {
    Route::get('/', 'donorpanel\LoginController@showLoginForm')->name('donor.login');
    Route::post('/submit', 'donorpanel\LoginController@login')->name('donor.login.submit');
    
  });
  //register donor
  Route::group(['prefix' => '/register'], function () {
    Route::get('/', 'donorpanel\RegisterController@showRegistrationForm')->name('donor.register');
    Route::get('/verify', 'donorpanel\RegisterController@showVerificationForm')->name('donor.register.code');
    Route::post('/verify', 'donorpanel\VerificationController@verify')->name('donor.store.code.verify');
    Route::post('/', 'donorpanel\RegisterController@store')->name('donor.store');
  });
  //donor verification code
  //Route::get('/code/{code}', 'donorpanel\VerificationController@verify')->name('donor.verification');
  
});

// API routes
Route::get('/donor/register/get-districts/{id}', function ($id) {
  return json_encode(App\Models\District::where('dis_division_id', $id)->get());
});
Route::get('/donor/register/get-upazila/{id}', function ($id) {
  return json_encode(App\Models\Upazila::where('upa_district_id', $id)->get());
});
Route::get('/donor/register/get-union/{id}', function ($id) {
  return json_encode(App\Models\Union::where('uni_upazila_id', $id)->get());
});
// API routes for search
Route::get('/get-districts/{id}', function ($id) {
  return json_encode(App\Models\District::where('dis_division_id', $id)->get());
});
Route::get('/get-upazila/{id}', function ($id) {
  return json_encode(App\Models\Upazila::where('upa_district_id', $id)->get());
});
Route::get('/get-union/{id}', function ($id) {
  return json_encode(App\Models\Union::where('uni_upazila_id', $id)->get());
});

//Mango_people_route

Route::get('/', 'mango_people\PageController@index')->name('mango_people');
Route::post('/submit', 'mango_people\PageController@send_request')->name('send_req');
