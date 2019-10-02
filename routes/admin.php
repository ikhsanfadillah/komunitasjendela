<?php

Route::group(['as' => 'admin.','middleware'=>['auth']], function(){
    Route::get('/dashboard', function () { return view('pages.misc.maintance'); })->name('dashboard');
    Route::resource('relawan','RelawanController');
    Route::post('/relawan/import','RelawanController@import')->name('relawan.import');
    Route::get('/relawan/statistic','RelawanController@statistic')->name('relawan.statistic');
    Route::resource('student','StudentController');
    Route::get('/student/statistic','StudentController@statistic')->name('student.statistic');
    Route::resource('branch','branchController');
    Route::resource('subbranch','SubbranchController');
    Route::resource('student-attendance','StudentAttendanceController');
    Route::post('/volunteer-attendance/attend','VolunteerAttendanceController@attend')->name('volunteer-attendance.attend');
    Route::put('/volunteer-attendance/checked/{id}','VolunteerAttendanceController@checked')->name('volunteer-attendance.checked');
    Route::post('/volunteer-attendance/multiple','VolunteerAttendanceController@multiple')->name('volunteer-attendance.multiple');
    Route::resource('event','EventController');
    Route::resource('volunteer-attendance','VolunteerAttendanceController');
    Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::resource('menu-builder','MenuController');

    Route::post('/menu-builder/reordering', 'MenuController@reordering')->name('menu-builder.reordering');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('default');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');