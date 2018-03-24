<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

@include('api_routes.php');
@include('frontend_route.php');




Route::get('/admin/auth/logout', ['as' => 'admin.logout', function () {
	Auth::logout();
	return redirect()->route('admin.auth.getLogin');
}]);

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function() {

	Route::group(['prefix' => 'auth', 'middleware' => 'AuthAdmin'], function() {
		
		Route::get('/login', ['as' => 'admin.auth.getLogin', 'uses' => 'UserController@getLogin']);
		Route::post('/login', ['as' => 'admin.auth.postLogin', 'uses' => 'UserController@postLogin']);
	
	});

	Route::group(['middleware' => 'NotAuthAdmin'] , function () {

		//Company Profile

		Route::group(['prefix' => 'company'], function() {
			Route::get('/create', ['as' => 'admin.companyprofile.getCreate', 'uses' => 'CompanyProfileController@getCreate']);
			Route::post('/create', ['as' => 'admin.companyprofile.postCreate', 'uses' => 'CompanyProfileController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.companyprofile.getUpdate', 'uses' => 'CompanyProfileController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.companyprofile.postUpdate', 'uses' => 'CompanyProfileController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.companyprofile.postDelete', 'uses' => 'CompanyProfileController@postDelete']);
			Route::get('/getView', ['as' => 'admin.companyprofile.getView', 'uses' => 'CompanyProfileController@getView']);
			Route::get('/', ['as' => 'admin.companyprofile.getIndex', 'uses' => 'CompanyProfileController@index']);
		});

		//Company Size

		Route::group(['prefix' => 'companysize'], function() {
			Route::get('/create', ['as' => 'admin.companysize.getCreate', 'uses' => 'CompanySizeController@getCreate']);
			Route::post('/create', ['as' => 'admin.companysize.postCreate', 'uses' => 'CompanySizeController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.companysize.getUpdate', 'uses' => 'CompanySizeController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.companysize.postUpdate', 'uses' => 'CompanySizeController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.companysize.postDelete', 'uses' => 'CompanySizeController@postDelete']);
			Route::get('/', ['as' => 'admin.companysize.getIndex', 'uses' => 'CompanySizeController@index']);
		});

		//Industry

		Route::group(['prefix' => 'industry'], function() {
			Route::get('/create', ['as' => 'admin.industry.getCreate', 'uses' => 'IndustryController@getCreate']);
			Route::post('/create', ['as' => 'admin.industry.postCreate', 'uses' => 'IndustryController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.industry.getUpdate', 'uses' => 'IndustryController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.industry.postUpdate', 'uses' => 'IndustryController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.industry.postDelete', 'uses' => 'IndustryController@postDelete']);
			Route::get('/', ['as' => 'admin.industry.getIndex', 'uses' => 'IndustryController@index']);
		});

		//Currency

		Route::group(['prefix' => 'currency'], function() {
			Route::get('/create', ['as' => 'admin.currency.getCreate', 'uses' => 'CurrencyController@getCreate']);
			Route::post('/create', ['as' => 'admin.currency.postCreate', 'uses' => 'CurrencyController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.currency.getUpdate', 'uses' => 'CurrencyController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.currency.postUpdate', 'uses' => 'CurrencyController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.currency.postDelete', 'uses' => 'CurrencyController@postDelete']);
			Route::get('/', ['as' => 'admin.currency.getIndex', 'uses' => 'CurrencyController@index']);
		});

		//Country

		Route::group(['prefix' => 'country'], function() {

			Route::get('/create', ['as' => 'admin.country.getCreate', 'uses' => 'CountryController@getCreate']);
			Route::post('/create', ['as' => 'admin.country.postCreate', 'uses' => 'CountryController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.country.getUpdate', 'uses' => 'CountryController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.country.postUpdate', 'uses' => 'CountryController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.country.postDelete', 'uses' => 'CountryController@postDelete']);
			Route::get('/', ['as' => 'admin.country.getIndex', 'uses' => 'CountryController@index']);

		});

		// Location 

		Route::group(['prefix' => 'location'], function() {

			Route::get('/create', ['as' => 'admin.location.getCreate', 'uses' => 'LocationController@getCreate']);
			Route::post('/create', ['as' => 'admin.location.postCreate', 'uses' => 'LocationController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.location.getUpdate', 'uses' => 'LocationController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.location.postUpdate', 'uses' => 'LocationController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.location.postDelete', 'uses' => 'LocationController@postDelete']);
			Route::get('/', ['as' => 'admin.location.getIndex', 'uses' => 'LocationController@index']);
		});

		// Notification

		Route::group(['prefix' => 'notification'], function() {

			Route::get('/create', ['as' => 'admin.notification.getCreate', 'uses' => 'NotificationController@getCreate']);
			Route::post('/create', ['as' => 'admin.notification.postCreate', 'uses' => 'NotificationController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.notification.getUpdate', 'uses' => 'NotificationController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.notification.postUpdate', 'uses' => 'NotificationController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.notification.postDelete', 'uses' => 'NotificationController@postDelete']);
			Route::get('/', ['as' => 'admin.notification.getIndex', 'uses' => 'NotificationController@index']);
		});

		// Skill 

		Route::group(['prefix' => 'skill'], function() {

			Route::get('/create', ['as' => 'admin.skill.getCreate', 'uses' => 'SkillController@getCreate']);
			Route::post('/create', ['as' => 'admin.skill.postCreate', 'uses' => 'SkillController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.skill.getUpdate', 'uses' => 'SkillController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.skill.postUpdate', 'uses' => 'SkillController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.skill.postDelete', 'uses' => 'SkillController@postDelete']);
			Route::get('/', ['as' => 'admin.skill.getIndex', 'uses' => 'SkillController@index']);
		});

		// contact

		Route::group(['prefix' => 'contact'], function() {
			Route::get('/view', ['as' => 'admin.contact.getView', 'uses' => 'ContactController@getView']);
			Route::post('/delete', ['as' => 'admin.contact.postDelete', 'uses' => 'ContactController@postDelete']);
			Route::get('/', ['as' => 'admin.contact.getIndex', 'uses' => 'ContactController@index']);
		});

		//feedback
		Route::group(['prefix' => 'feedback'], function() {			
			Route::post('/delete', ['as' => 'admin.feedback.postDelete', 'uses' => 'FeedbackController@postDelete']);
			Route::get('/', ['as' => 'admin.feedback.getIndex', 'uses' => 'FeedbackController@index']);
		});
		//end

		//term
		Route::group(['prefix' => 'term'], function() {			
			Route::get('/create', ['as' => 'admin.term.getCreate', 'uses' => 'TermController@getCreate']);
			Route::post('/create', ['as' => 'admin.term.postCreate', 'uses' => 'TermController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.term.getUpdate', 'uses' => 'TermController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.term.postUpdate', 'uses' => 'TermController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.term.postDelete', 'uses' => 'TermController@postDelete']);
			Route::get('/', ['as' => 'admin.term.getIndex', 'uses' => 'TermController@index']);
		});
		//end

		//joblevel
		Route::group(['prefix' => 'joblevel'], function() {			
			Route::get('/create', ['as' => 'admin.joblevel.getCreate', 'uses' => 'JobLevelController@getCreate']);
			Route::post('/create', ['as' => 'admin.joblevel.postCreate', 'uses' => 'JobLevelController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.joblevel.getUpdate', 'uses' => 'JobLevelController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.joblevel.postUpdate', 'uses' => 'JobLevelController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.joblevel.postDelete', 'uses' => 'JobLevelController@postDelete']);
			Route::get('/', ['as' => 'admin.joblevel.getIndex', 'uses' => 'JobLevelController@index']);
		});
		//end

		//privacy
		Route::group(['prefix' => 'privacy'], function() {			
			Route::get('/create', ['as' => 'admin.privacy.getCreate', 'uses' => 'PrivacyController@getCreate']);
			Route::post('/create', ['as' => 'admin.privacy.postCreate', 'uses' => 'PrivacyController@postCreate']);
			Route::get('/update/{id}', ['as' => 'admin.privacy.getUpdate', 'uses' => 'PrivacyController@getUpdate']);
			Route::post('/update/{id}', ['as' => 'admin.privacy.postUpdate', 'uses' => 'PrivacyController@postUpdate']);
			Route::post('/delete', ['as' => 'admin.privacy.postDelete', 'uses' => 'PrivacyController@postDelete']);
			Route::get('/', ['as' => 'admin.privacy.getIndex', 'uses' => 'PrivacyController@index']);
		});
		//end

		// user

		Route::group(['prefix' => 'user'], function () {
			// create user admin
			Route::get('/create', ['as' => 'admin.user.getCreate', 'uses' => 'UserController@getCreate']);
			Route::post('/create', ['as' => 'admin.user.postCreate', 'uses' => 'UserController@postCreate']);
			// create user seeker
			Route::get('/createSeeker', ['as' => 'admin.user.getCreateSeeker', 'uses' => 'UserController@getCreateSeeker']);
			Route::post('/createSeeker', ['as' => 'admin.user.postCreateSeeker', 'uses' => 'UserController@postCreateSeeker']);
			// create user company
			Route::get('/createCompany', ['as' => 'admin.user.getCreateCompany', 'uses' => 'UserController@getCreateCompany']);
			Route::post('/createCompany', ['as' => 'admin.user.postCreateCompany', 'uses' => 'UserController@postCreateCompany']);
			//delete
			Route::post('/delete', ['as' => 'admin.user.postDelete', 'uses' => 'UserController@postDelete']);
			// view
			Route::get('/view/{id}', ['as' => 'admin.user.getView', 'uses' => 'UserController@getView']);
			//get update
			Route::get('/update/{id}', ['as' => 'admin.user.getUpdate', 'uses' => 'UserController@getUpdate']);
			//post update
			Route::post('/update/{id}', ['as' => 'admin.user.postUpdate', 'uses' => 'UserController@postUpdate']);
			//get index
			Route::get('/', ['as' => 'admin.user.getIndex', 'uses' => 'UserController@getIndex']);
		});

		// job 

		Route::group(['prefix' => 'job'], function () {
			Route::get('/create', ['as' => 'admin.job.getCreate', 'uses' => 'JobController@getCreate']);
			Route::post('/create', ['as' => 'admin.job.postCreate', 'uses' => 'JobController@postCreate']);
			//delete
			Route::post('/delete', ['as' => 'admin.job.postDelete', 'uses' => 'JobController@postDelete']);
			// view
			Route::get('/view', ['as' => 'admin.job.getView', 'uses' => 'JobController@getView']);
			//get update
			// Route::get('/update/{id}', ['as' => 'admin.job.getUpdate', 'uses' => 'JobController@getUpdate']);
			// //post update
			// Route::post('/update/{id}', ['as' => 'admin.job.postUpdate', 'uses' => 'JobController@postUpdate']);
			//get index
			Route::get('/', ['as' => 'admin.job.getIndex', 'uses' => 'JobController@getIndex']);


			//download file job exel
			Route::get('downloadJob/{type}', 'ExelController@downloadJob');
			//end dowwload

		});

		// job seeker 

		Route::group(['prefix' => 'job-seeker'], function () {
			//delete
			Route::post('/delete', ['as' => 'admin.job-seeker.postDelete', 'uses' => 'JobSeekerController@postDelete']);
			// view
			Route::get('/view', ['as' => 'admin.job-seeker.getView', 'uses' => 'JobSeekerController@getView']);
			//get update
			// Route::get('/update/{id}', ['as' => 'admin.job-seeker.getUpdate', 'uses' => 'JobSeekerController@getUpdate']);
			// //post update
			// Route::post('/update/{id}', ['as' => 'admin.job-seeker.postUpdate', 'uses' => 'JobSeekerController@postUpdate']);
			//get index
			Route::get('/', ['as' => 'admin.job-seeker.getIndex', 'uses' => 'JobSeekerController@getIndex']);
		});

		Route::group(['prefix' => '/'], function() {
			Route::get('/', ['as' => 'admin.home', 'uses' => 'HomeController@getIndex']);
		});
                
                //export exel
                Route::get('export', ['as' => 'admin.user.export', 'uses' =>'ExelController@downloadUser']);
                //end
	});

});
