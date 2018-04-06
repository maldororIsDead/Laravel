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

Route::get('/', 'PagesController@getWelcomePage');

//User cabinet
Route::get('/home', 'HomeController@index')->name('home');
Route::put('/home/upload/{id?}', 'HomeController@uploadPhoto')->name('photo.upload');

//Search vacancies
Route::get('/search/vacancies', 'PagesController@searchVacancies');

//Categories
Route::get('/categories/{id?}/resumes', 'PagesController@showVacancyCategory')->name('category-worker');

Route::get('/categories/{id?}/vacancy', 'PagesController@showResumeCategory')->name('category-company');

//Guest views
Route::get('/all/vacancies', 'PagesController@getAllVacancies')->name('all-vacancies');

Route::get('/all/resumes', 'PagesController@getAllResumes')->name('all-resumes');

Route::get('/all/vacancies/{id?}', 'PagesController@getVacancy')->name('vacancy');

Route::get('/all/resumes/{id?}', 'PagesController@getResume')->name('resume');

Route::get('/all/resumes/download/{id?}/', 'PagesController@downloadResume')->name('download');

//Company views
Route::group(['middleware' => 'role:company'], function()
{
    Route::resource('vacancies', 'VacancyController');
    Route::get('/all/vacancies/{id?}/resumes', 'VacancyController@showReceiveResumes')->name('receive-resumes');
    Route::get('/search/resumes', 'VacancyController@searchResumes');
});

//Worker views
Route::group(['middleware' => 'role:worker'], function()
{
    Route::resource('resume', 'ResumeController');
    Route::get('/all/resumes/{id?}/vacancies', 'ResumeController@showSendVacancies')->name('send-vacancies');
    Route::get('/worker/all/vacancies/{id?}/', 'ResumeController@selectResume')->name('worker-vacancy');
    Route::post('/worker/all/vacancies/{id?}/', 'ResumeController@sendResume')->name('send-resume');
});

