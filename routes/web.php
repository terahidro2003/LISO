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

Route::get('/', 'SignupsController@create')->name('SignupFormPublic');
Route::post('/', ['as' => '/', 'uses' => 'SignupsController@store'])->name('SignupFormPublicPublish');

Route::get('signups', 'SignupsController@index')->name('viewSignups');
Route::get('api/signups', 'SignupsController@indexAPI')->name('api.signups');
Route::get('api/signups/filter/city/{cityID}', 'SignupsController@showCurrentCity')->name('api.signups.filter.city');

Route::post('signups/delete', 'SignupsController@destroy')->name('signup.destroy');

Route::any('dancer/create', 'DancerController@signup2store')->name('api.signup.member.store');
Route::any('api/members/store', 'DancerController@storeAPI')->name('api.member.store');
Route::get('members', 'DancerController@index')->name('members.index');
Route::get('api/members', 'DancerController@indexAPI')->name('api.members');
Route::any('members/{dancerID}/edit', 'DancerController@edit')->name('members.edit');
Route::any('members/{dancerID}/update', 'DancerController@update')->name('members.update');
Route::any('members/{dancerID}/payments/change', 'PaymentsController@changePaymentSettings')->name('members.changePaymentSettings');
Route::get('members/{dancerID}/delete', 'DancerController@destroy')->name('members.delete');

Route::any('api/groups/create', 'GroupsController@store');
Route::get('groups', 'GroupsController@index')->name('groups.index');
Route::get('api/groups', 'GroupsController@indexAPI')->name('api.groups');
Route::get('groups/{groupID}/edit', 'GroupsController@edit')->name('groups.edit');
Route::post('groups/{groupID}/update', 'GroupsController@update')->name('groups.update');
Route::get('groups/{groupID}/show', 'GroupsController@members')->name('groups.show');

Route::any('payments/new', 'PaymentsController@store')->name('payments.store');
Route::get('payments', 'PaymentsController@index')->name('payments.index');

Route::get('rfid', 'RFIDController@index')->name('rfid.index');
Route::any('rfid/scan', 'RFIDController@scan')->name('rfid.scan');
Route::any('rfid/store', 'RFIDController@store')->name('rfid.store');

Route::get('stats/studio', 'StatisticsController@index')->name('stats.studio');
Auth::routes();

Route::get('api/stats/balance/{range}', 'StatisticsController@balanceHistory')->name('api.stats.balance');
Route::get('api/stats/payments/{range}', 'StatisticsController@paymentsHistory')->name('api.stats.payments');
Route::get('api/stats/economy/{range}', 'StatisticsController@economyHistory')->name('api.stats.economy');

Route::any('/api/search', "HomeController@search")->name('search');
Route::any('/search', "HomeController@search")->name('search.form');

Route::get('system/versions', "HomeController@versionInfo")->name('system.updates');
Route::post('system/versions/new', "HomeController@newVersion")->name('system.updates.new');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/api/factory/signups/generate/{amount}', 'HomeController@signupGenerator');
