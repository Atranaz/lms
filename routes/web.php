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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/teacher', 'TeacherController@store');
Route::put('/teacher/{id}', 'TeacherController@update');
Route::get('/teachers', 'TeacherController@index')->name('teachers');
Route::get('/teacher/add', 'TeacherController@create')->name('addteacher');
Route::get('/teacher/{id}/delete', 'TeacherController@destroy')->name('deleteteacher');
Route::get('/teacher/{id}/edit', 'TeacherController@edit')->name('editteacher');


Route::post('class_assign', 'TeacherController@classAssign');
Route::get('/teacher/assign', 'TeacherController@showAssignClass')->name('assignclass');


Route::get('/teacher/attendance', 'TeacherController@attendanceShow')->name('attendance');
Route::get('/attendance/{id}', 'TeacherController@updateAttendance')->name('updateattendance');
