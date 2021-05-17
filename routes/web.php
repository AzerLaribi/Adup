<?php

Route::get('/', function () {
    return view('welcome');
});
// Location Partner Login Page
Route::get('/LocationPartnerLogin', function () {
    return view('auth.locationPartnerLogin');
});

// Advertiser Partner Login Page
Route::get('/AdvertiserPartnerLogin', function () {
    return view('auth.advertiserPartnerLogin');
});
// Add new Tag for inscription
Route::get('/AddTag', function () {
    return view('LocationPartner.addTags');
});
Route::Post('/AddTag', 'LocationpartnerController@addTag');

// Add new Type for inscription
Route::get('/AddType', function () {
    return view('LocationPartner.addType');
});
Route::Post('/AddType', 'LocationpartnerController@AddType');

// Add new Domaine for inscription
Route::get('/AddDomaine', function () {
    return view('Advertiser.AddDomaine');
});
Route::Post('/AddDomaine', 'AdvertiserController@AddDomaine');

// Locationpartner
Route::resource('locationpartner','LocationpartnerController');

// advertiser
Route::resource('advertiser','AdvertiserController');


Route::get('/Location','LocationpartnerController@create');


Route::get('/Advertiser','AdvertiserController@create');


Route::Post('/saveCon', 'HomeController@store');

Route::get('speaker/{speaker}', 'HomeController@view')->name('speaker');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);
Route::Get('saveMe/', 'HomeController@storeMe')->name('consumers.saveMe');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');


    // Schedules
    Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('schedules.massDestroy');
    Route::resource('schedules', 'ScheduleController');

    // Venues
    Route::delete('venues/destroy', 'VenuesController@massDestroy')->name('venues.massDestroy');
    Route::post('venues/media', 'VenuesController@storeMedia')->name('venues.storeMedia');
    Route::resource('venues', 'VenuesController');

    Route::resource('rasbarys', 'RasbaryController');

    Route::resource('ads', 'AdController');

    Route::get('{venueID}/adLocations','AdController@adLocations')->name('admin.ads.adLocations');
    //Route::get('{adid}/ven','AdController@venInfo')->name('admin.ads.ven');
    Route::get('{venueID}/adsInmylocations','VenuesController@adLocations')->name('admin.ads.adLocations');
    Route::get('/Mac/{mac}', 'HomeController@rasbary')->name('rasbary');

    Route::resource('consumers', 'ConsumerController');
    Route::resource('events', 'EventController');

    Route::resource('vus', 'VuController');
    Route::resource('rasbsconsumores', 'ConsumerRasbController');

    Route::resource('tags', 'TagController');

    Route::resource('types', 'TypController');

    Route::resource('locationpartner','LocationpartnerController');
    Route::put('/locationpartner_validation/{id}', 'LocationpartnerController@validation')->name('Validation');

    Route::resource('domaine','DomaineController');
    Route::get('/Profile','Admin\UsersController@profile');

    Route::resource('advertiser','AdvertiserController');
    Route::put('/advertise_validation/{id}', 'AdvertiserController@validation');

    Route::put('/ads_validation/{id}', 'AdController@validation');

    Route::resource('advertiserpartner','AdvertiserPartnerController');
    Route::get('/ads_Video','AdvertiserPartnerController@createVideo');
    Route::get('/show_ad/{id}','AdvertiserPartnerController@show');
    Route::get('/ads_Image','AdvertiserPartnerController@createImage');
    Route::put('/store_Video','AdvertiserPartnerController@storeVideo');
    Route::put('/store_Image','AdvertiserPartnerController@storeImage');

});
