<?php

use App\Models\Pages\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

if (\App::runningInConsole()) return; //чтобы не было проблем с миграциями

// Route::get('/', function () {
//     $locale = app()->getLocale();
//     if ($locale != 'ru')
//         return redirect(app()->getLocale());
// });

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    include('admin.php');

    $urls = [
        'history' => Pages::getUrlByCode('istoriia'),
        'courses' => Pages::getUrlByCode('kursy-povyseniia-kvalifikacii'),
        'vacancies' => Pages::getUrlByCode('vakansii'),
        'administration' => Pages::getUrlByCode('administraciia'),
        'structure' => Pages::getUrlByCode('struktura'),
        'staff' => Pages::getUrlByCode('sotrudniki'),
        'contacts' => Pages::getUrlByCode('contacts'),
        'branches' => Pages::getUrlByCode('filialy'),
        'council' => Pages::getUrlByCode('dissertacionnyi-sovet'),
        'eform' => Pages::getUrlByCode('eform'),
        'publications2' => Pages::getUrlByCode('publikacii'),
        'publications' => Pages::getUrlByCode('izdaniia'),
        'aspirantura' => Pages::getUrlByCode('aspirantura'),
        'magazine' => Pages::getUrlByCode('zurnal-gidrologiceskii-vestnik'),
        'search' => Pages::getUrlByCode('search')
    ];

    Route::get('web', function () {})->middleware('auth:sanctum', 'acount');

    $languages = config('app.available_locales');

    foreach ($languages as $language) {

        Route::group(['prefix' => $language != 'ru' ? $language : '', 'as' => $language != 'ru' ? $language . '.' : '', 'middleware' => 'setlocale'], function () use ($urls) {
            Route::get('/', 'IndexController@main')->name('main');

            Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
                Route::get('/', 'IndexController@news')->name('index');
                Route::get('/{link}', 'IndexController@newsSingle')->name('single');
            });

            Route::group(['prefix' => 'arxiv-novostei', 'as' => 'arxiv-novostei.'], function () {
                Route::get('/', 'IndexController@arxiv_novostei')->name('index');
                Route::get('/{link}', 'IndexController@arxiv_novosteiSingle')->name('single');
            });

            Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
                Route::get('/', 'IndexController@services')->name('index');
                Route::get('/{link}', 'IndexController@servicesSingle')->name('single');
            });

            Route::group(['prefix' => $urls['courses'], 'as' => 'courses.'], function () {
                Route::get('/', 'IndexController@courses')->name('index');
                Route::get('/{link}', 'IndexController@coursesSingle')->name('single');
            });

            Route::group(['prefix' => $urls['publications2'], 'as' => 'publications2.'], function () {
                Route::get('/', 'IndexController@publications2')->name('index');
                Route::get('/{publication}', 'IndexController@publications2Single')->name('single');
            });

            Route::group(['prefix' => $urls['structure'], 'as' => 'structure.'], function () {
                Route::get('/', 'IndexController@structure')->name('index');
                Route::get('/{department}', 'IndexController@structureSingle')->name('single');
            });


            Route::get('/' . $urls['history'], 'IndexController@about')->name('about');
            Route::get('/' . $urls['vacancies'], 'IndexController@vacancies')->name('vacancies');
            Route::get('/' . $urls['administration'], 'IndexController@administration')->name('administration');

            Route::get('/' . $urls['staff'], 'IndexController@staff')->name('staff');

            Route::get('/' . $urls['contacts'], 'IndexController@contacts')->name('contacts');
            Route::get('/' . $urls['branches'], 'IndexController@branches')->name('branches');

            Route::get('/' . $urls['council'], 'IndexController@council')->name('council');
            Route::get('/' . $urls['publications'], 'IndexController@publications')->name('publications');
            Route::get('/' . $urls['magazine'], 'IndexController@magazine')->name('magazine');
            Route::get('/' . $urls['aspirantura'], 'IndexController@aspirantura')->name('aspirantura');


            Route::match(['get', 'post'], '/' . $urls['eform'], 'IndexController@eform')->name('eform');
            Route::match(['get', 'post'], '/' . $urls['search'], 'IndexController@search')->name('search');

            Route::view('/auth', 'pages.auth');

            Route::view('/graduate', 'pages.graduate');

            Route::get('/{url}', 'IndexController@page')->name('page')->where('url',  '^(?!(en|document)).*$');
        });
    }

    Route::get('document', function (Request $request) {
        return '<body style="margin:0;padding:0;overflow:hidden;"><iframe style="width:100vw;height:100vh;" src="https://docs.google.com/gview?url=' . urlencode($request->path) . '&embedded=true"></iframe></body>';
    })->name('document');

    Route::post('ajax/{method}', 'AjaxController@index');
});


//Route::view('{any?}' , 'app' );

//Route::view('/service', 'pages.service');
//Route::view('/about', 'pages.about');
// Route::view('/courses', 'pages.courses');
//Route::view('/news', 'pages.news');

// Route::view('/corruption', 'pages.corruption');
// // Route::view('/course', 'pages.course');
// // Route::view('/administration', 'pages.administration');


// Route::view('/structure', 'pages.structure');
// Route::view('/ip', 'pages.ip');
//    Route::view('/branches', 'pages.branches');
