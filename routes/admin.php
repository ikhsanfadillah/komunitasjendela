<?php

Route::group(['as' => 'admin.','middleware'=>['auth']], function(){
    Route::get('/dashboard', function () { return view('pages.forms.forms'); })->name('dashboard');
    Route::resource('relawan','RelawanController');
    Route::get('/relawan/statistic','RelawanController@statistic')->name('relawan.statistic');
    Route::resource('student','StudentController');
    Route::get('/student/statistic','StudentController@statistic')->name('student.statistic');
    Route::resource('branch','branchController');
    Route::resource('subbranch','SubbranchController');
    Route::resource('student-attendance','StudentAttendanceController');
    Route::resource('volunteer-attendance','VolunteerAttendanceController');

    Route::resource('menu-builder','MenuController');

    Route::post('/menu-builder/reordering', 'MenuController@reordering')->name('menu-builder.reordering');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('default');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');