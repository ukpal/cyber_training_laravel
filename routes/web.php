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

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/old', function () {
    return view('frontend.pages.home');
});
Route::get('/', function () {
    return view('frontend.new_pages.home');
});
Route::get('/about-cyber-yoddha', 'Frontend\YoddhaController@about_cyber_yoddha');
Route::get('/contact-us', 'Frontend\YoddhaController@contact_us');


Route::prefix('cyber-yoddha')->group(function () {
    Route::get('/old-register', function () {
        return view('frontend.yoddha.register');
    });
    Route::get('/register', 'Frontend\YoddhaController@register');
    Route::get('/yoddha-login', 'Frontend\YoddhaController@yoddha_login');
    Route::get('/student-internship-list', 'Frontend\YoddhaController@internship_list');
    Route::post('/submission', 'Frontend\YoddhaController@submission');

    Route::get('/login', 'frontend\YoddhaController@login');
    Route::post('/login', 'frontend\YoddhaController@authenticate');
    Route::post('/verify-otp', 'frontend\YoddhaController@verify_otp');
    Route::get('/logout', 'frontend\YoddhaController@logout');
    Route::get('/dashboard', 'frontend\YoddhaController@dashboard');
    Route::get('/yoddha-team', 'frontend\YoddhaController@yoddha_team');

    Route::get('/my-tasks', 'frontend\TaskController@myTasks');
    Route::get('/view-task/{id}', 'frontend\TaskController@viewTask');
    Route::post('/reply-task', 'frontend\TaskController@replyTask');
});    

Route::get('/login', 'Backend\UserController@login');
Route::post('/login', 'Backend\UserController@authenticate');
Route::post('/verify-otp', 'Backend\UserController@verify_otp');
Route::post('/login-as', 'Backend\UserController@login_as');
Route::get('/logout', 'Backend\UserController@logout');
Route::get('/dashboard', 'Backend\UserController@dashboard');
Route::get('/my-profile', 'Backend\UserController@myProfile');

Route::get('/members/add-{module}', 'Backend\UserController@add_member');
Route::get('/members/{slug}', 'Backend\UserController@members');
Route::post('/members/save-{module}', 'Backend\UserController@save_member');
Route::match(['GET','POST'],'/edit-member/{id?}', 'Backend\UserController@updateMember');

Route::get('/yoddha-team', 'Backend\UserController@yoddha_team');
Route::get('/spoc', 'Backend\UserController@spoc_details');
Route::get('/yoddha-registered/{status?}', 'Backend\UserController@yoddha_registered');
Route::get('/yoddha-scrutiny/{status?}', 'Backend\UserController@yoddha_scrutiny');
Route::get('/yoddha-details/{ids}', 'Backend\UserController@yoddha_details');
Route::get('/yoddha-details-scrutiny/{ids}', 'Backend\UserController@yoddha_details_scrutiny');
Route::post('/update-status', 'Backend\UserController@update_status');
Route::post('/scrutiny-status', 'Backend\UserController@scrutiny_status');
Route::post('/spoc-change', 'Backend\UserController@spoc_change');
Route::match(['GET','POST'],'/assign-task/{id?}','Backend\TaskController@assignTask');
Route::match(['GET'],'/allocated-tasks/{id}','Backend\TaskController@allocatedTask');
Route::match(['GET'],'/view-task/{id}','Backend\TaskController@viewTask');
Route::match(['POST'],'/task-interaction','Backend\TaskController@taskInteraction');
Route::match(['GET'],'/deactivate-yoddha/{id}','Backend\UserController@deactivateYoddha');
Route::match(['GET'],'/activate-yoddha/{id}','Backend\UserController@activateYoddha');



Route::prefix('user')->group(function () {
    Route::get('/', 'Backend\PageController@index');
    Route::get('/add-page', 'Backend\PageController@add_page');
    Route::get('/edit-page/{id}', 'Backend\PageController@edit_page');
    Route::post('/save-page', 'Backend\PageController@save_page');
    Route::post('/delete-page', 'Backend\PageController@delete_page');
});
