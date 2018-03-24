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
Route::group(['prefix' => 'api', 'namespace'=>'Api', 'middleware'=>'apibase'], function() {
	Route::group(['prefix' => 'v1'], function() {
		Route::group(['prefix'=>'users'], function (){
			//user
			Route::post('/postRegister', ['as'=>'api.users.postRegister', 'uses'=>'UsersController@postRegister']);
            Route::post('/sendPricing', ['as'=>'api.users.sendPricing', 'uses'=>'UsersController@sendPricing']);
			Route::post('/postRegisterEmployee', ['as'=>'api.users.postRegisterEmployee', 'uses'=>'UsersController@postRegisterEmployee']);
			Route::post('/postLogin', ['as' => 'api.users.postLogin', 'uses' => 'UsersController@postLogin']);
            Route::post('/postForgot', ['as' => 'api.users.postForgot', 'uses' => 'UsersController@postForgot']);
			Route::post('/changePassword', ['as' => 'api.users.changePassword', 'uses' => 'UsersController@changePassword']);
			Route::post('/postRegisterSocialite', ['as' => 'api.users.postRegisterSocialite', 'uses' => 'UsersController@postRegisterSocialite']);
			Route::post('/postLoginSocialite', ['as' => 'api.user.postLoginSocialite', 'uses' => 'UsersController@postLoginSocialite']);
			Route::post('/getToken', ['as'=>'api.users.getToken', 'uses'=>'UsersController@getToken']);
			Route::get('/getListEmployee/{sign}/{app_id}/{device_type}', ['as' => 'api.users.getListEmployee', 'uses' => 'UsersController@getListEmployee']);
            Route::get('/getListExperience/{sign}/{app_id}/{device_type}', ['as' => 'api.users.getListExperience', 'uses' => 'UsersController@getListExperience']);
            Route::get('/getListTerm/{sign}/{app_id}/{device_type}', ['as' => 'api.users.getListTerm', 'uses' => 'UsersController@getListTerm']);
            Route::get('/getAllNotification/{sign}/{app_id}/{device_type}', ['as' => 'api.users.getAllNotification', 'uses' => 'UsersController@getAllNotification']);
            Route::get('/getUserProfile/{sign}/{app_id}/{device_type}', ['as' => 'api.users.getUserProfile', 'uses' => 'UsersController@getUserProfile']);
            Route::get('/getLogout/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.user.getLogout', 'uses' => 'UsersController@getLogout']);
            Route::get('/getCreditNumber/{sign}/{app_id}/{device_type}/{CompanyID}', ['as' => 'api.user.getCreditNumber', 'uses' => 'UsersController@getCreditNumber']);
            Route::get('/getAllPrivacy/{sign}/{app_id}/{device_type}', ['as' => 'api.user.getAllPrivacy', 'uses' => 'UsersController@getAllPrivacy']);
		});

        Route::group(['prefix'=>'employment'], function (){
            Route::get('/getListEmployment/{sign}/{app_id}/{device_type}', ['as' => 'api.employment.getListEmployment', 'uses' => 'EmploymentTypeController@getListEmployment']);
        });

        Route::group(['prefix'=>'jobseekerskill'], function (){
            Route::get('/getAllUserSkill/{sign}/{app_id}/{device_type}', ['as' => 'api.jobseekerskill.getAllUserSkill', 'uses' => 'JobSeekerSkill@getAllUserSkill']);
        });

        Route::group(['prefix'=>'jobseekerexperience'], function (){
            Route::get('/getAllUserExperience/{sign}/{app_id}/{device_type}', ['as' => 'api.jobseekerexperience.getAllUserExperience', 'uses' => 'JobSeekerExperience@getAllUserExperience']);
        });

        //Notification
        Route::group(['prefix'=>'notification'], function (){
            Route::post('/setNotification', ['as' => 'api.notification.setNotification', 'uses' => 'Notification_Controller@setNotification']);

            //count all notification
            Route::post('/countAllNotification', ['as' => 'api.notification.countAllNotification', 'uses' => 'Notification_Controller@countAllNotification']);
            Route::post('/deleteNotificationByID', ['as' => 'api.notification.deleteNotificationByID', 'uses' => 'Notification_Controller@deleteNotificationByID']);
            Route::post('/deleteNotification', ['as' => 'api.notification.deleteNotification', 'uses' => 'Notification_Controller@deleteNotification']);
            Route::post('/updateNotificationStatus', ['as' => 'api.notification.updateNotificationStatus', 'uses' => 'Notification_Controller@updateNotificationStatus']);
            Route::get('/getListNotification/{sign}/{app_id}/{device_type}', ['as' => 'api.notification.getListNotification', 'uses' => 'Notification_Controller@getListNotification']);
        });

		//Invite
		Route::group(['prefix'=>'invite'], function (){
			Route::post('/setInvite', ['as' => 'api.invite.setInvite', 'uses' => 'InviteController@setInvite']);
			Route::post('/setInvite1', ['as' => 'api.invite.setInvite1', 'uses' => 'InviteController@setInvite1']);
			Route::get('/getListInvitation/{sign}/{app_id}/{device_type}', ['as' => 'api.invite.getListInvitation', 'uses' => 'InviteController@getListInvitation']);
            Route::get('/testNotify/{sign}/{app_id}/{device_type}', ['as' => 'api.invite.testNotify', 'uses' => 'InviteController@testNotify']);
            Route::get('/testNotify1/{sign}/{app_id}/{device_type}', ['as' => 'api.invite.testNotify1', 'uses' => 'InviteController@testNotify1']);
		});

		//CompanySize
		Route::group(['prefix'=>'companysize'], function (){
			Route::get('/getListCompanySize/{sign}/{app_id}/{device_type}', ['as' => 'api.companysize.getListCompanySize', 'uses' => 'CompanySizeController@getListCompanySize']);
		});

		//Feedback
		Route::group(['prefix'=>'feedback'], function (){
			Route::post('/addFeedback', ['as'=>'api.feedback.addFeedback', 'uses'=>'FeedbackController@addFeedback']);
		});

		//Category
		Route::group(['prefix'=>'category'], function (){
			Route::post('/addCategory', ['as' => 'api.category.addCategory', 'uses' => 'CategoryController@addCategory']);
			Route::post('/updateCategory', ['as' => 'api.category.updateCategory', 'uses' => 'CategoryController@updateCategory']);
			Route::post('/deleteCategory', ['as' => 'api.category.deleteCategory', 'uses' => 'CategoryController@deleteCategory']);
			Route::get('/getListCategory/{sign}/{app_id}/{device_type}', ['as' => 'api.category.getListCategory', 'uses' => 'CategoryController@getListCategory']);
		});

		//Interview
		Route::group(['prefix'=>'interview'], function (){
            Route::post('/rejectInterview', ['as' => 'api.interview.rejectInterview', 'uses' => 'InterviewController@rejectInterview']);
			Route::post('/setInterview', ['as' => 'api.interview.setInterview', 'uses' => 'InterviewController@setInterview']);
            Route::post('/updateInterviewStatus', ['as' => 'api.interview.updateInterviewStatus', 'uses' => 'InterviewController@updateInterviewStatus']);
            Route::post('/deleteInterview', ['as' => 'api.interview.deleteInterview', 'uses' => 'InterviewController@deleteInterview']);
			Route::get('/getInterviewDetail/{sign}/{app_id}/{device_type}', ['as' => 'api.interview.getInterviewDetail', 'uses' => 'InterviewController@getInterviewDetail']);
			Route::get('/getAnInterviewDetail/{sign}/{app_id}/{device_type}', ['as' => 'api.interview.getAnInterviewDetail', 'uses' => 'InterviewController@getAnInterviewDetail']);
			Route::get('/getListInterView/{sign}/{app_id}/{device_type}', ['as' => 'api.interview.getListInterView', 'uses' => 'InterviewController@getListInterView']);
		});

		//Shortlist
		Route::group(['prefix'=>'shortlist'], function (){
			Route::post('/addShortlist', ['as' => 'api.shortlist.addShortlist', 'uses' => 'ShortlistController@addShortlist']);
			Route::post('/deleteShortlist', ['as' => 'api.shortlist.deleteShortlist', 'uses' => 'ShortlistController@deleteShortlist']);
			Route::get('/getShortlist/{sign}/{app_id}/{device_type}', ['as' => 'api.shortlist.getShortlist', 'uses' => 'ShortlistController@getShortlist']);
		});

		// skill
		Route::group(['prefix'=>'skill'], function (){
			Route::get('/getListSkill/{sign}/{app_id}/{device_type}/{user_id}', ['as' => 'api.skill.getListSkill', 'uses' => 'SkillController@getListSkill']);
		});

		// industry
		Route::group(['prefix'=>'industry'], function (){
			Route::get('/getListIndustry/{sign}/{app_id}/{device_type}', ['as' => 'api.industry.getListIndustry', 'uses' => 'IndustryController@getListIndustry']);
		});

		// country
		Route::group(['prefix'=>'country'], function (){
			Route::get('/getAllCountry/{sign}/{app_id}/{device_type}', ['as' => 'api.user.getAllCountry', 'uses' => 'CountryController@getAllCountry']);
		});

		// location
		Route::group(['prefix'=>'location'], function (){
			Route::get('/getAllLocationOnCountry/{sign}/{app_id}/{device_type}/{country_id}', ['as' => 'api.user.getAllLocationOnCountry', 'uses' => 'LocationController@getAllLocationOnCountry']);
		});
		Route::group(['prefix'=>'jobs'], function (){
            Route::get('/getListLevel/{sign}/{app_id}/{device_type}', ['as' => 'api.jobs.getListLevel', 'uses' => 'JobsController@getListLevel']);
            Route::get('/getIndustry/{sign}/{app_id}/{device_type}', ['as' => 'api.jobs.getIndustry', 'uses' => 'JobsController@getIndustry']);
			Route::get('/getCountJob/{sign}/{app_id}/{device_type}/{location_id}', ['as' => 'api.jobs.getCountJob', 'uses' => 'JobsController@getCountJob']);
			Route::get('/getListJob/{sign}/{app_id}/{device_type}', ['as' => 'api.jobs.getListJob', 'uses' => 'JobsController@getListJob']);
			//Route::get('/getJobDetail/{sign}/{app_id}/{device_type}/{job_id}', ['as' => 'api.jobs.getJobDetail', 'uses' => 'JobsController@getJobDetail']);
			Route::get('/getJobDetail/{sign}/{app_id}/{device_type}/{user_id}/{job_id}', ['as' => 'api.jobs.getJobDetail', 'uses' => 'JobsController@getJobDetail']);
			Route::get('/getListJobInLocation/{sign}/{app_id}/{device_type}/{lat}/{lng}', ['as' => 'api.jobs.getListJobInLocation', 'uses' => 'JobsController@getListJobInLocation']);
		});
		
	});

	
});
Route::group(['prefix' => 'api', 'namespace'=>'Api', 'middleware'=>['apibase', 'apitoken']], function() {
	Route::group(['prefix' => 'v1'], function() {
		Route::group(['prefix'=>'users'], function (){
			Route::post('/postResetPassword', ['as'=>'api.users.postResetPassword', 'uses'=>'UsersController@postResetPassword']);
			//edit seeker
			Route::post('/postUpdateJobSeeker', ['as' => 'api.user.postUpdateJobSeeker', 'uses' => 'UsersController@postUpdateJobSeeker']);
			Route::get('/getUserDetail/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.user.getUserDetail', 'uses' => 'UsersController@getUserDetail']);
			Route::post('/postAvatarUploadFile', ['as'=>'api.companyprofile.postAvatarUploadFile', 'uses'=>'UsersController@postAvatarUploadFile']);

			
			//Route::post('/getToken', ['as'=>'api.user.getToken', 'uses'=>'UsersController@getToken']);
		});
		// company profile
		Route::group(['prefix'=>'companyprofile'], function (){
			Route::post('/postUpdateCompany', ['as'=>'api.companyprofile.postUpdateCompany', 'uses'=>'CompanyProfileController@postUpdateCompany']);
			Route::post('/postCompanyUploadFile', ['as'=>'api.companyprofile.postCompanyUploadFile', 'uses'=>'CompanyProfileController@postCompanyUploadFile']);
			Route::get('/getCompanyProfile/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.companyprofile.getCompanyProfile', 'uses' => 'CompanyProfileController@getCompanyProfile']);
		});

		
		// jobs
		Route::group(['prefix'=>'jobs'], function (){
			
			Route::post('/postSaveJob', ['as' => 'api.jobs.postSaveJob', 'uses' => 'JobsController@postSaveJob']);
            Route::post('/extendJob', ['as' => 'api.jobs.extendJob', 'uses' => 'JobsController@extendJob']);
            Route::post('/postCreateJob', ['as' => 'api.jobs.postCreateJob', 'uses' => 'JobsController@postCreateJob']);
            Route::post('/postEditJob', ['as' => 'api.jobs.postEditJob', 'uses' => 'JobsController@postEditJob']);
			Route::post('/postDeleteSaveJob', ['as' => 'api.jobs.postDeleteSaveJob', 'uses' => 'JobsController@postDeleteSaveJob']);
			Route::post('/postAppliedJob', ['as' => 'api.jobs.postAppliedJob', 'uses' => 'JobsController@postAppliedJob']);
			Route::post('/postDeleteJob', ['as' => 'api.jobs.postDeleteJob', 'uses' => 'JobsController@postDeleteJob']);
			Route::post('/postDeleteAppliedJob', ['as' => 'api.jobs.postDeleteAppliedJob', 'uses' => 'JobsController@postDeleteAppliedJob']);
			Route::get('/getAppliedJob/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.jobs.getAppliedJob', 'uses' => 'JobsController@getAppliedJob']);
			Route::get('/getSaveJob/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.jobs.getSaveJob', 'uses' => 'JobsController@getSaveJob']);
			

			
		});

		

		// jobseekerexperience
		Route::group(['prefix'=>'jobseekerexperience'], function (){
			Route::get('/getAllJobSeekerExperience/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.jobseekerexperience.getAllJobSeekerExperience', 'uses' => 'JobSeekerExperience@getAllJobSeekerExperience']);
			Route::post('/postAddJobSeekerExperience', ['as'=>'api.jobseekerexperience.postAddJobSeekerExperience', 'uses'=>'JobSeekerExperience@postAddJobSeekerExperience']);
			Route::post('/postUpdateJobSeekerExperience', ['as'=>'api.jobseekerexperience.postUpdateJobSeekerExperience', 'uses'=>'JobSeekerExperience@postUpdateJobSeekerExperience']);
			Route::post('/postDeleteJobSeekerExperience', ['as'=>'api.jobseekerexperience.postDeleteJobSeekerExperience', 'uses'=>'JobSeekerExperience@postDeleteJobSeekerExperience']);
		});


		// jobseekerexperience
		Route::group(['prefix'=>'jobseekerskill'], function (){
			Route::get('/getAllJobSeekerSkill/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.jobseekerskill.getAllJobSeekerSkill', 'uses' => 'JobSeekerSkill@getAllJobSeekerSkill']);
			Route::post('/postAddJobSeekerSkill', ['as'=>'api.jobseekerskill.postAddJobSeekerSkill', 'uses'=>'JobSeekerSkill@postAddJobSeekerSkill']);
			Route::post('/postDeleteJobSeekerSkill', ['as'=>'api.jobseekerskill.postDeleteJobSeekerSkill', 'uses'=>'JobSeekerSkill@postDeleteJobSeekerSkill']);
		});

		// country
		Route::group(['prefix'=>'files'], function (){
			Route::post('/postUploadFile', ['as'=>'api.files.postUploadFile', 'uses'=>'CompanyProfileController@postCompanyUploadFile']);
		});

		// skill
		Route::group(['prefix'=>'skill'], function (){
			Route::post('/postEditSkill', ['as' => 'api.skill.postEditSkill', 'uses' => 'SkillController@postEditSkill']);
		});
		// notification
		Route::group(['prefix'=>'notification'], function (){
			Route::get('/getListNotification/{sign}/{app_id}/{device_type}/{user_id}/{ApiToken}', ['as' => 'api.notification.getListNotification', 'uses' => 'UsersController@getListNotification']);
			Route::post('/postRemoveNotification', ['as' => 'api.notification.postRemoveNotification', 'uses' => 'UsersController@postRemoveNotification']);
		});

	});

	//Company Profile

	/*Route::group(['prefix' => 'companyprofile'], function() {
		Route::get('/create', ['as' => 'admin.companyprofile.getCreate', 'uses' => 'CompanyProfileController@getCreate']);
		Route::post('/create', ['as' => 'admin.companyprofile.postCreate', 'uses' => 'CompanyProfileController@postCreate']);
		Route::get('/update/{id}', ['as' => 'admin.companyprofile.getUpdate', 'uses' => 'CompanyProfileController@getUpdate']);
		Route::post('/update/{id}', ['as' => 'admin.companyprofile.postUpdate', 'uses' => 'CompanyProfileController@postUpdate']);
		Route::post('/delete', ['as' => 'admin.companyprofile.postDelete', 'uses' => 'CompanyProfileController@postDelete']);
		Route::get('/', ['as' => 'admin.companyprofile.getIndex', 'uses' => 'CompanyProfileController@index']);
	});*/

});
