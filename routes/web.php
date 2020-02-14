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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group( function(){
//    Route::post('admin/attendace/search', 'AttendanceSearchController@index')->name('admin.searchAttendane.show');
//    Route::get('admin/attendance/search', 'AttendanceController@index')->name('admin.searchAttendance.show');
    Route::get('admin/attendance/', 'AttendanceController@index')->name('admin.attendance.index');
//    Route::get('admin/attendance/create', 'AttendanceController@create')->name('admin.attendance.create');
//    Route::get('admin/attendance/show/{attendance}', 'AttendanceController@show')->name('admin.attendance.show');
    Route::get('admin/attendance/{id}/{jenis}', 'AttendanceController@show')->name('kehadiran');
    Route::patch('admin/attendance/student', 'AttendanceController@store');
    Route::get('admin/attendance/student/{id}/detail', 'AttendanceController@showStudent');
    Route::get('admin/attendance/edit/{id}/detail', 'AttendanceController@edit')->name('detailabsen');
    Route::patch('admin/attendance/edit/{id}', 'AttendanceController@update')->name('editabsen');
});

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('home', 'HomeController@index')->name('home');

    require(__DIR__ . '/backend/master.php');
});
