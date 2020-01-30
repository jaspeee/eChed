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

Route::get('/', function () {
    return view('welcome');
});


// ENCODER
Route::get('/encoder/dashboard', 'EncoderController@Page_dashboard');
Route::get('/encoder/forms', 'EncoderController@Page_form');
Route::get('/encoder/upload', 'EncoderController@Page_upload');
Route::get('/encoder/track', 'EncoderController@Page_track');
Route::post('/encoder/upload', 'EncoderController@Upload_file');
Route::get('/encoder/password', 'EncoderController@Page_password');
Route::patch('/encoder/changepass', 'EncoderController@Password_change');
Route::get('/encoder/references', 'EncoderController@Page_references');

// VALIDATOR
Route::get('/validator/dashboard', 'ValidatorController@Page_dashboard');
Route::get('/validator/validation', 'ValidatorController@Page_validation');
Route::get('/validator/track', 'ValidatorController@Page_track');
Route::get('/validator/records', 'ValidatorController@Page_records');
Route::get('/validator/accounts', 'ValidatorController@Page_accounts');
Route::patch('/validator/validation/approve/{form}', 'ValidatorController@Validation_approve');
Route::patch('/validator/validation/disapprove/{id}', 'ValidatorController@Validation_disapproves');
Route::patch('/validator/accounts/{status}/{id}', 'ValidatorController@Validation_accstat');
Route::post('/validator/accounts/add', 'ValidatorController@Accounts_add');
Route::get('/validator/password', 'ValidatorController@Page_password');
Route::patch('/validator/changepass', 'ValidatorController@Password_change');
Route::get('/validator/references', 'ValidatorController@Page_references');

// VERIFIER
Route::get('/verifier/dashboard', 'VerifierController@Page_dashboard');
Route::get('/verifier/verification', 'VerifierController@Page_verification');
Route::get('/verifier/verify/{ins_id}', 'VerifierController@Page_verify');
Route::patch('/verifier/verify/approve/{form}', 'VerifierController@Verify_approve');
Route::patch('/verifier/verify/disapprove/{id}', 'VerifierController@Verify_disapprove');
Route::get('/verifier/password', 'VerifierController@Page_password');
Route::patch('/verifier/changepass', 'VerifierController@Password_change');
Route::get('/verifier/references', 'VerifierController@Page_references');

// OFFICER 
Route::get('/officer/dashboard', 'OfficerController@Page_dashboard');
Route::get('/officer/finalization', 'OfficerController@Page_finalization');
Route::get('/officer/reports', 'OfficerController@Page_reports'); 
Route::get('/officer/deadline', 'OfficerController@Page_deadline');
Route::get('/officer/final/{ins_id}', 'OfficerController@Page_final');
Route::get('/officer/accounts', 'OfficerController@Page_account');
Route::get('/officer/accounts/verifier', 'OfficerController@Page_account_verifier');
Route::get('/officer/accounts/validator', 'OfficerController@Page_account_validator');
Route::patch('/officer/accounts/{status}/{id}', 'OfficerController@Account_verifier_status');
Route::post('/officer/accounts/add', 'OfficerController@Account_verifier_add');
Route::post('/officer/accounts/validator/add', 'OfficerController@Account_validator_add');
Route::get('/officer/password', 'OfficerController@Page_password');
Route::patch('/officer/changepass', 'OfficerController@Password_change');
Route::post('/officer/deadline/add', 'OfficerController@Deadline_add'); 
Route::get('/officer/collation', 'OfficerController@Page_collation');
Route::get('/officer/analytics', 'OfficerController@Page_analytics');
Route::get('/officer/references', 'OfficerController@Page_references');


//REPORTS
Route::get('/officer/collate', 'ReportsController@import'); 
Route::get('/officer/exports', 'ReportsController@exports');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

