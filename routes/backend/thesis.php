<?php
/** Routing Modul Administrasi Tugas Akhir */
Route::resource('theses', 'ThesisController');

Route::delete('thesis-supervisors/{thesis_id}/{lecturer_id}','ThesisSupervisorController@destroy')
    ->name('thesis-supervisors.destroy');
Route::get('thesis-supervisors/{thesis_id}','ThesisSupervisorController@create')
    ->name('thesis-supervisors.create');
Route::post('thesis-supervisors','ThesisSupervisorController@store')
    ->name('thesis-supervisors.store');

Route::resource('{thesis_id}/thesis-logbooks','ThesisLogbookController')
    ->only(['index','create','store','destroy']);
