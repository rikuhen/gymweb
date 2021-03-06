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

// Route::auth();


Route::get('/','Client\HomeController@showHome');

Route::group(['prefix' => 'auth'],function(){

	Route::get('login','Client\Auth\AuthController@getLogin')->name('client.auth.login');
	Route::post('login','Client\Auth\AuthController@postLogin')->name('client.auth.postlogin');

});



/********admin********/

Route::group(['prefix' => 'admgym'],function(){
	
	Route::get('/', function () {
		if (Auth::guard('web')->guest()) {
			return redirect()->route('admgym.auth.login');	
		} else {
			return redirect()->route('admgym.dashboard');
		}
	});

	Route::group(['prefix' => 'auth'],function(){

		Route::get('login','Admin\Auth\AuthAdminController@getLogin')->name('admgym.auth.login');
		Route::post('login','Admin\Auth\AuthAdminController@postLogin')->name('admgym.auth.postlogin');
		Route::get('logout','Admin\Auth\AuthAdminController@logout')->name('admgym.auth.logout');

	});


	Route::get('/dashboard','Admin\DashboardController@showDashboard')->name('admgym.dashboard');

	//profile
	Route::get('/profile','Admin\User\ProfileController@index')->name('admgym.profile.index');
	Route::post('/profile','Admin\User\ProfileController@update')->name('admgym.profile.update');


	Route::resource('members','Admin\Member\MemberController');
	Route::resource('members.memberships','Admin\Membership\MembershipController',['only'=>['create','store','update']]);
	Route::resource('members.memberships.assistances','Admin\Membership\MembershipAssistanceDetailController',['only'=>['index','store']]);
	Route::resource('members.memberships.payments','Admin\Membership\MembershipPaymentDetailController',['only'=>['index','create','store']]);

	Route::group(['prefix'=>'memberships'],function(){
		Route::resource('categories','Admin\Membership\CategoryController',['except'=>['show']]);
		Route::resource('types','Admin\Membership\MembershipTypeController',['except'=>['show']]);
	});

	Route::group(['prefix'=>'admreports'],function(){
		Route::get('members','Admin\Report\MemberReportController@showReports')->name('admreports.members');
		Route::get('get-assistance/{params?}','Admin\Report\MemberReportController@getAssistance')->name('admreports.members.assistances');
		Route::get('print-assistance/{params}','Admin\Report\MemberReportController@printAssistance')->name('admreports.members.assistances.print');
	});

	Route::group(['middleware'=>['auth','role:administrator']],function(){
		
		Route::resource('users','Admin\User\UserController',['except'=>['show']]);
		Route::resource('permissions','Admin\User\PermissionController',['except'=>['show']]);
		Route::resource('roles','Admin\User\RoleController',['except'=>['show']]);

		Route::group(['prefix'=>'logs'],function(){
			Route::resource('user-access','Admin\Log\UserAccessLogController',['only'=>['index']]);
			Route::resource('member-access','Admin\Log\MemberAccessLogController',['only'=>['index']]);
		});
	});

});
