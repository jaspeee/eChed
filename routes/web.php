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

//Clear configurations:
Route::get('/config-clear', function() {
	$status = Artisan::call('config:clear');
	return '<h1>Configurations cleared</h1>';
});

//Clear cache:
Route::get('/cache-clear', function() {
	$status = Artisan::call('cache:clear');
	return '<h1>Cache cleared</h1>';
});

//Clear configuration cache:
Route::get('/config-cache', function() {
	$status = Artisan::call('config:Cache');
	return '<h1>Configurations cache cleared</h1>';
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
//Route::get('/encoder/try/try/try', 'EncoderController@tryyyyy');
Route::get('/encoder/audit/{val}', 'EncoderController@audit');


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
Route::get('/validator/audit/{val}', 'ValidatorController@audit_download');
Route::get('/validator/record/{val}', 'ValidatorController@record_download');


// VERIFIER
Route::get('/verifier/dashboard', 'VerifierController@Page_dashboard');
Route::get('/verifier/verification', 'VerifierController@Page_verification');
Route::get('/verifier/verify/{ins_id}', 'VerifierController@Page_verify');
Route::patch('/verifier/verify/approve/{form}', 'VerifierController@Verify_approve');
Route::patch('/verifier/verify/disapprove/{id}', 'VerifierController@Verify_disapprove');
Route::get('/verifier/password', 'VerifierController@Page_password');
Route::patch('/verifier/changepass', 'VerifierController@Password_change');
Route::get('/verifier/references', 'VerifierController@Page_references');
Route::get('/verifier/audit/{val}', 'VerifierController@audit_download');


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
Route::patch('/officer/deadline/add', 'OfficerController@Deadline_add'); 
Route::get('/officer/collation', 'OfficerController@Page_collation');
//Route::get('/officer/analytics', 'OfficerController@Page_analytics');
Route::get('/officer/references', 'OfficerController@Page_references');
Route::get('/officer/accounts/officer', 'OfficerController@Page_account_officer');
Route::post('/officer/accounts/officer', 'OfficerController@Account_officer_add');
Route::patch('/officer/final/approve/{form}', 'OfficerController@officer_approve'); 
Route::patch('/officer/final/disapprove/{form}', 'OfficerController@officer_disapprove'); 
Route::post('/officer/institution', 'OfficerController@Institution_add');
Route::patch('/officer/account/edit/{id}', 'OfficerController@Account_edit');
Route::get('/officer/audit/{val}', 'OfficerController@audit_download');
Route::get('/officer/auditlogs', 'OfficerController@auditlogs');
Route::get('/officer/backup', 'OfficerController@backup');
Route::get('/officer/startbackup', 'OfficerController@startbackup');
Route::get('/officer/collatefiles', 'OfficerController@collatefiles');
Route::get('/officer/collatefiles/result/{id}', 'OfficerController@result_collatefiles');
Route::get('/officer/analytics/{id}', 'OfficerController@analytics');
Route::patch('/officer/status/{status}/{id}', 'OfficerController@status');
Route::get('/officer/archives', 'OfficerController@archives');
Route::get('/officer/archives/{id}', 'OfficerController@downloadArchive');

Route::patch('/officer/request/{id}/{type}', 'OfficerController@Account_request');  
Route::patch('/officer/collatefiles/remove/{id}', 'OfficerController@remove_collate'); 
Route::post('/officer/audit/export', 'ReportsController@audit_export'); 


//REPORTS
Route::get('/officer/collate', 'ReportsController@import'); 
Route::get('/officer/exports/{id}', 'ReportsController@exports');
Route::post('/officer/collatefiles/add', 'ReportsController@addcollation');



//INACTIVE ACC REDIRECT
Route::get('/account', 'AccountController@Page_acc');
Route::post('/inactive/req', 'AccountController@Page_inactive_req');

//FORGOT PASSWORD 
Route::get('/forgotpassword', 'AccountController@Page_forgot');
Route::post('/forgotpassword/req', 'AccountController@Page_forgot_req');

//CHANGE PASSWORD
Route::patch('/account/changePass/{id}', 'AccountController@Accounts_changePass');
  

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
}); 

