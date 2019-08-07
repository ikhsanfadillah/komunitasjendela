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

//Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>['auth']], function(){
//    Route::get('/dashboard', function () { return view('pages.forms.forms'); })->name('dashboard');
//    Route::resource('relawan','RelawanController');
//    Route::get('/relawan/statistic','RelawanController@statistic')->name('relawan.statistic');
//    Route::resource('student','StudentController');
//    Route::get('/student/statistic','StudentController@statistic')->name('student.statistic');
//    Route::resource('branch','branchController');
//    Route::resource('subbranch','SubbranchController');
//    Route::resource('student-attendance','StudentAttendanceController');
//    Route::resource('volunteer-attendance','VolunteerAttendanceController');
//    Route::resource('menu-builder','MenuController');
//    Route::post('/menu-builder/reordering', 'MenuController@reordering')->name('menu-builder.reordering');
//
//    Route::get('/test', function () {
//    })->name('test');
//});
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
use App\Models\Event;

Route::get('/login2', function () {
    return view('auth.login2');
})->name('login2');
Route::post('/volunteer-attendance/self-attending','VolunteerAttendanceController@selfAttending')->name('volunteer-attendance.self-attending');
Route::get('/attendance/volunteer/{slug}','VolunteerAttendanceController@eventAttend')->name('volunteer-attendance.eventAttend');


