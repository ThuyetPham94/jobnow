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
// View::composer('public.includes.nav', function($view) {
//     $category = Category::tree();
//     return $view->with('category', $category);
// });

Route::get('/', ['as' => 'public.home' , 'uses'=>'SiteController@index']);

Route::group(['prefix' => 'user'], function () {

	Route::post('/login-seeker', ['as' => 'public.user.seeker.postLoginSeeker', 'uses' => 'UserController@postLogin']);
	Route::post('/forgot-seeker', ['as' => 'public.user.seeker.postForgotSeeker', 'uses' => 'UserController@postForgot']);

	Route::post('/signup-seeker', ['as' => 'public.user.seeker.postRegister', 'uses' => 'UserController@seekerPostRegister']);

	Route::post('/change-pass', ['as' => 'public.user.postChangePass', 'uses' => 'UserController@postChangePass']);

	Route::get('/loginFB', ['as' => 'public.user.seeker.loginFB', 'uses' => 'UserController@loginFB']);

	Route::get('/callback', ['as' => 'public.user.seeker.callback', 'uses' => 'UserController@callback']);

	Route::get('/logout', ['as' => 'public.user.logout', 'uses' => 'UserController@logout']);

});
Route::group(['prefix' => 'MyProfile', 'middleware' => 'seeker'], function() {

	//save job
	Route::get('/saveJob', ['as' => 'public.myprofile.getSaveJob', 'uses' => 'MyProfileController@getSaveJob']);
	//applied job
	Route::get('/appliedJob', ['as' => 'public.myprofile.getAppliedJob', 'uses' => 'MyProfileController@getAppliedJob']);

	Route::post('/postUpdate', ['as' => 'public.myprofile.postUpdate', 'uses' => 'MyProfileController@postUpdate']);
	// add experince
	Route::post('/postCreateEx', ['as' => 'public.myprofile.postCreateEx', 'uses' => 'MyProfileController@postCreateEx']);
	//delete experince
	Route::get('/deleteEx/{id}', ['as' => 'public.myprofile.getDeleteEx', 'uses' => 'MyProfileController@getDeleteEx']);
	// create skill
	Route::post('/postCreateSkill', ['as' => 'public.myprofile.postCreateSkill', 'uses' => 'MyProfileController@postCreateSkill']);
	Route::post('/postRemoveSkill', ['as' => 'public.myprofile.postRemoveSkill', 'uses' => 'MyProfileController@postRemoveSkill']);
	//upload avatar
	Route::post('/postAvatar', ['as' => 'public.myprofile.postAvatar', 'uses' => 'MyProfileController@postAvatar']);
	//inter view
	Route::get('/interview', ['as' => 'public.myprofile.getInterview', 'uses' => 'MyProfileController@getInterview']);
	// interview detail
	Route::post('/getDetail', ['as' => 'public.myprofile.getDetail', 'uses' => 'MyProfileController@getDetail']);
	// status
	Route::post('/setStatus', ['as' => 'public.myprofile.setStatus', 'uses' => 'MyProfileController@setStatus']);
	Route::post('/removeNotification', ['as' => 'public.myprofile.removeNotification', 'uses' => 'MyProfileController@removeNotification']);


	Route::get('/', ['as' => 'public.myprofile.index', 'uses' => 'MyProfileController@index']);
	Route::get('/ListInterview', ['as' => 'public.myprofile.ListInterview', 'uses' => 'MyProfileController@ListInterview']);

	Route::get('/downloadCVSeeker/{file}',['as'=> 'public.company.interview.downloadCVSeeker','uses'=>'ManageCompanyController@downloadCV']);
});

// Route company

Route::group(['prefix' => 'ManageCompany'], function () {

	Route::group(['prefix' => 'auth', 'middleware' => 'authCompany'], function () {
		Route::get('/login', ['as' => 'public.company.getLogin' , 'uses' => 'ManageCompanyController@getLogin']);

		Route::post('/login', ['as' => 'public.company.postLogin' , 'uses' => 'ManageCompanyController@postLogin']);

		Route::get('/register', ['as' => 'public.company.getRegister' , 'uses' => 'ManageCompanyController@getRegister']);

		Route::post('/register', ['as' => 'public.company.postRegister' , 'uses' => 'ManageCompanyController@postRegister']);

		//trung
		Route::get('/Companyregister', ['as' => 'public.company.getCompanyRegister' , 'uses' => 'ManageCompanyController@getCompanyRegister']);
		Route::post('/Companyregister', ['as' => 'public.company.postCompanyregister' , 'uses' => 'ManageCompanyController@postCompanyregister']);
	});

	//job

	Route::group(['middleware' => 'company'], function () {
		Route::group(['prefix' => 'job'], function() {
			Route::get('/create', [ 'as' => 'public.company.job.getCreate', 'uses' => 'ManageCompanyController@getCreateJob']);
			Route::post('/create', [ 'as' => 'public.company.job.postCreate', 'uses' => 'ManageCompanyController@postCreateJob']);
			Route::get('/update', [ 'as' => 'public.company.job.getUpdate', 'uses' => 'ManageCompanyController@getUpdateJob']);
			Route::post('/update', [ 'as' => 'public.company.job.postUpdate', 'uses' => 'ManageCompanyController@postUpdateJob']);
			Route::post('/delete', [ 'as' => 'public.company.job.postDelete', 'uses' => 'ManageCompanyController@postDeleteJob']);
			Route::post('/DeleteImageCompany', [ 'as' => 'public.company.job.postDeleteImageCompany', 'uses' => 'ManageCompanyController@postDeleteImageCompany']);
			Route::get('/', [ 'as' => 'public.company.job.index', 'uses' => 'ManageCompanyController@indexJob']);
			// update by hung
			Route::get('/done-hiring', [ 'as' => 'public.company.job.done-hiring', 'uses' => 'ManageCompanyController@getDoneHiring']);
			// end update by hung
		});

		//Login 

		// search resume 
		Route::get('/interview', ['as' => 'public.company.interview', 'uses' => 'ManageCompanyController@interview']);
		// set interview
		Route::post('/setInterview', ['as' => 'public.company.setInterview', 'uses' => 'ManageCompanyController@setInterview']);
		///
		Route::post('/editSetInterview', ['as' => 'public.company.editSetInterview', 'uses' => 'ManageCompanyController@editSetInterview']);
        Route::post('/editSetInterviewShortlist', ['as' => 'public.company.editSetInterviewShortlist', 'uses' => 'ManageCompanyController@editSetInterviewShortlist']);
		// get edit interview 
		Route::post('/getEditInterview', ['as' => 'public.company.getEditInterview', 'uses' => 'ManageCompanyController@getEditInterview']);
        Route::post('/getEditInterviewShortlist', ['as' => 'public.company.getEditInterviewShortlist', 'uses' => 'ManageCompanyController@getEditInterviewShortlist']);
        Route::post('/getInterviewSeeker', ['as' => 'public.company.getInterviewSeeker', 'uses' => 'ManageCompanyController@getInterviewSeeker']);
		// delete interview
		Route::get('/delInterview', ['as' => 'public.company.delInterview', 'uses' => 'ManageCompanyController@delInterview']);
		//view contact
		/*
		update interview
		 */
		Route::get('/rejectInterview', ['as' => 'public.company.rejectInterview', 'uses' => 'ManageCompanyController@rejectInterview']);
		//	
		Route::get('/view/{id}', ['as' => 'public.company.viewContact', 'uses' => 'ManageCompanyController@viewContact']);
		//
		Route::get('/account', ['as' => 'public.company.account', 'uses' => 'ManageCompanyController@account']);

		Route::post('/account', ['as' => 'public.company.account.postUpdate', 'uses' => 'ManageCompanyController@postUpdate']);

		Route::post('/account/changeMail', ['as' => 'public.company.postChangeMail', 'uses' => 'ManageCompanyController@postChangeMail']);

		Route::get('/', [ 'as' => 'public.company.index', 'uses' => 'ManageCompanyController@getIndex']);
		Route::get('/Applicants/{id}', ['as'=>'public.company.getApplycants', 'uses'=>'ManageCompanyController@getApplycants'])->where(['id' => '^[0-9]+$']);

		/*
		Author:thuyet
		*/

		Route::get('/privacy',['as'=> 'public.company.setting.privacy','uses'=>'ManageCompanyController@privacy']);
		Route::get('/websetting',['as'=> 'public.company.setting.websetting','uses'=>'ManageCompanyController@websetting']);
		// update by hung
		Route::post('/update-phone',['as'=> 'public.company.setting.update-phone','uses'=>'ManageCompanyController@updatePhone']);
		// end update by hung
		Route::get('/credit',['as'=> 'public.company.setting.credit','uses'=>'ManageCompanyController@credit']);
                Route::post('/updateCredit',['as'=> 'public.company.setting.updateCredit','uses'=>'ManageCompanyController@updateCredit']);
		Route::get('/feedback',['as'=> 'public.company.setting.feedback','uses'=>'ManageCompanyController@feedback']);
                Route::post('/feedback',['as'=> 'public.company.setting.postfeedback','uses'=>'ManageCompanyController@postfeedback']);
		Route::get('/detailinterview/{id}',['as'=> 'public.company.interview.detail','uses'=>'ManageCompanyController@detailinterview']);
		//update by hung
		Route::group(["prefix"=>"shortlist"],function(){
			Route::get('/',['as'=> 'public.company.shortlist.shortlist','uses'=>'ManageCompanyController@shortlist']);
			Route::post('/update-category',['as'=> 'public.company.shortlist.updatecategory','uses'=>'ManageCompanyController@updateShortlistCategory']);
			Route::post('/delete-shortlist-category',['as'=> 'public.company.shortlist.delete-shortlist-category','uses'=>'ManageCompanyController@deleteShortlistCategory']);
		});

		Route::get('/invite',['as'=> 'public.company.setting.getInvite','uses'=>'ManageCompanyController@getInvite']);
		Route::post('/invite',['as'=> 'public.company.setting.postInvite','uses'=>'ManageCompanyController@postInvite']);
		
		//gia hạn
		Route::get('/extend/{id}',['as'=> 'public.company.job.extend','uses'=>'ManageCompanyController@extend']);
		//end

		Route::get('/test-invite',['as'=> 'public.company.setting.getInvite','uses'=>'ManageCompanyController@testInvite']);

		Route::get('/term',['as'=> 'public.company.setting.term','uses'=>'ManageCompanyController@term']);

		// end update by hung
		Route::get('/addemployee/{id}',['as'=> 'public.company.employee.addemployee','uses'=>'ManageCompanyController@addemployee']);
                Route::post('/SearchEmployee',['as'=> 'public.company.employee.SearchEmployee','uses'=>'ManageCompanyController@SearchEmployee']);
		Route::get('/invitecredit',['as'=> 'public.company.setting.invitecredit','uses'=>'ManageCompanyController@invitecredit']);
                
        Route::post('/addcateogry',['as'=> 'public.company.shortlist.addcateogry','uses'=>'ManageCompanyController@AddCategory']);
        Route::post('/AddShortlist',['as'=> 'public.company.shortlist.AddShortlist','uses'=>'ManageCompanyController@AddShortlist']);
        Route::get('/downloadCV/{file}',['as'=> 'public.company.interview.downloadCV','uses'=>'ManageCompanyController@downloadCV']);
		/*end*/

		//route payment
		
		Route::get('checkout',['as'=>'public.company.checkout','uses'=>'ManageCompanyController@checkout']);

		//send mail to get credit
		Route::post('postPackage',['as'=>'public.company.postPackage','uses'=>'ManageCompanyController@postPackage']);

		//end

		

		//test view
		Route::get('testview',function(){
			return view('company.modules.test_email.sendinvite');
		});
		//end

	});
        Route::get('/confirm-invite',['as'=> 'public.company.setting.confirmInvite','uses'=>'ManageCompanyController@confirmInvite']);
});
//payment
Route::resource('payment','PaymentController');
//end
//test view
Route::get('FindTalent',function(){
	return view('company.modules.talent');
});//end
Route::get('PostJob',function(){
	return view('company.modules.home');
});//end
//

Route::group(['prefix' => 'job'], function () {

	Route::post('/appliedJob', ['as' => 'public.job.postApplied', 'uses' => 'JobController@postApplied']);

	// get skill

	Route::post('/getSkill', ['as' => 'public.job.getSkill', 'uses' => 'JobController@getSkill']); 

	Route::post('/savedJob', ['as' => 'public.job.postSaved', 'uses' => 'JobController@postSaved']);
	Route::post('/postApplyJob', ['as' => 'public.job.postApplyJob', 'uses' => 'JobController@postApplyJob']);

	Route::get('/{id}-{name}', ['as' => 'public.job.getDetail', 'uses' => 'JobController@getDetail'])->where(['id' => '^[0-9]+$', 'name' => '[a-zA-Z0-9\_\.\-]+']);

	Route::get('/', ['as' => 'public.job.index', 'uses' => 'JobController@index']);

});

// company detail

Route::group(['prefix' => 'company-profile'], function() {

	Route::post('/review', ['as' => 'public.company.review', 'uses' => 'CompanyController@postReview']);

	Route::post('/getReview', ['as' => 'public.company.getReview', 'uses' => 'CompanyController@getReview']);

	Route::post('/postEdit', ['as' => 'public.company.postEditReview', 'uses' => 'CompanyController@postEditReview']);

	Route::post('/delReview', ['as' => 'public.company.delReview', 'uses' => 'CompanyController@delReview']);

	Route::get('/{id}-{name}', ['as' => 'public.company.getDetail', 'uses' => 'CompanyController@getDetail'])->where(['id' => '^[0-9]+$', 'name' => '[a-zA-Z0-9\_\.\-]+']);
	Route::get('/', ['as' => 'public.company-profile.index', 'uses' => 'CompanyController@index']);
});


/// search company

Route::get('/search' , ['as' => 'public.company.search', 'uses' => 'CompanyController@search']);

// front-end-html

Route::get('/contact-us', ['as' => 'public.contactus', function () {
	return view()->make('frontend.template-html.contactus');
}]);

Route::post('/contact-us' , ['as' => 'public.postContact', 'uses' => 'SiteController@postContact']);

Route::get('/term-of-service', ['as' => 'public.term', function () {
	return view()->make('frontend.template-html.termofuse');
}]);

Route::get('/help', ['as' => 'public.help', function () {
	return view()->make('frontend.template-html.help');
}]);

Route::get('/privacy-policy', ['as' => 'public.privacy', function () {
	return view()->make('frontend.template-html.privacy');
}]);
Route::get('/safe', ['as' => 'public.safe', function () {
	return view()->make('frontend.template-html.safe');
}]);
Route::get('/about-us', ['as' => 'public.about', function () {
	return view()->make('frontend.template-html.aboutus');
}]);
Route::get('faqs', ['as' => 'public.faqs', function () {
	return view()->make('frontend.template-html.faqs');
}]);
Route::get('test_mail', ['as' => 'public.mail', function () {
	return view()->make('company.modules.test_email.sendinvite');
}]);


