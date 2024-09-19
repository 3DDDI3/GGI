<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::post('ajax', function (Request $request) {
        $controller = new \App\Http\Controllers\Admin\AdminAjax();
        $controller($request->action);
    })->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('login', 'LoginController@login')->name('login');

        Route::group(['middleware' => ['auth', 'admin', 'admin_access']], function () {

            Route::group(['prefix' => 'users', 'as' => 'users.', 'namespace' => 'Users'], function () {
                Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                    Route::get('/', 'UsersController@index')->name('index');
                    Route::match(['get', 'post'], '/edit/{id?}', 'UsersController@edit')->name('edit');
                });

                Route::group(['prefix' => 'classes', 'as' => 'classes.'], function () {
                    Route::get('/', 'UsersClassesController@index')->name('index');
                    Route::match(['get', 'post'], '/edit/{id?}', 'UsersClassesController@edit')->name('edit');
                });

                Route::group(['prefix' => 'admin_event_logs', 'as' => 'admin_event_logs.'], function () {
                    Route::get('/', 'AdminEventLogsController@index')->name('index');
                    Route::match(['get', 'post'], '/edit/{id?}', 'AdminEventLogsController@edit')->name('edit');
                });
            });

            Route::group(['prefix' => 'publications', 'as' => 'publications.'], function(){
                Route::get('/', 'PublicationsController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'PublicationsController@edit')->name('edit');
            });

            Route::group(['prefix' => 'publications2', 'as' => 'publications2.'], function(){
                Route::get('/', 'Publications2Controller@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'Publications2Controller@edit')->name('edit');
            });

            Route::group(['prefix' => 'magazine', 'as' => 'magazine.'], function(){
                Route::get('/', 'MagazineController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'MagazineController@edit')->name('edit');
            });

            Route::group(['prefix' => 'laboratories', 'as' => 'laboratories.'], function(){
                Route::get('/', 'LaboratoriesController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'LaboratoriesController@edit')->name('edit');
            });

            Route::group(['prefix' => 'subdivisions', 'as' => 'subdivisions.'], function(){
                Route::get('/', 'SubdivisionsController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'SubdivisionsController@edit')->name('edit');
            });

            Route::group(['prefix' => 'staff', 'as' => 'staff.'], function(){
                Route::get('/', 'StaffController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'StaffController@edit')->name('edit');
            });

            Route::group(['prefix' => 'departments', 'as' => 'departments.'], function(){
                Route::get('/', 'DepartmentsController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'DepartmentsController@edit')->name('edit');
            });

            Route::group(['prefix' => 'administration', 'as' => 'administration.'], function(){
                Route::get('/', 'AdministrationController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'AdministrationController@edit')->name('edit');
            });

            Route::group(['prefix' => 'vacancies', 'as' => 'vacancies.'], function(){
                Route::get('/', 'VacanciesController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'VacanciesController@edit')->name('edit');
            });

            Route::group(['prefix' => 'courses', 'as' => 'courses.'], function(){
                Route::get('/', 'CoursesController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'CoursesController@edit')->name('edit');
            });

            Route::group(['prefix' => 'portfolio', 'as' => 'portfolio.'], function(){
                Route::get('/', 'PortfolioController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'PortfolioController@edit')->name('edit');
            });

            Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
                Route::get('/', 'NewsController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'NewsController@edit')->name('edit');
            });

            Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
                Route::get('/', 'ServicesController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'ServicesController@edit')->name('edit');
            });

            Route::group(['prefix' => 'documents', 'as' => 'documents.'], function(){
                Route::get('/', 'DocumentsController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'DocumentsController@edit')->name('edit');
            });

            Route::group(['prefix' => 'council', 'as' => 'council.'], function () {
                Route::get('/', 'CouncilController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'CouncilController@edit')->name('edit');
            });

            Route::group(['prefix' => 'eform', 'as' => 'eform.'], function () {
                Route::get('/', 'EformController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'EformController@edit')->name('edit');
            });

            Route::group(['prefix' => 'branches', 'as' => 'branches.'], function(){
                Route::get('/', 'BranchesController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'BranchesController@edit')->name('edit');
            });

            Route::group(['prefix' => 'institute-objects', 'as' => 'institute-objects.'], function(){
                Route::get('/', 'InstituteObjectsController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'InstituteObjectsController@edit')->name('edit');
            });

            
            Route::group(['prefix' => 'formstyle', 'as' => 'formstyle.'], function () {
                Route::get('/', 'FormStyleController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'FormStyleController@edit')->name('edit');
            });

            Route::group(['prefix' => 'graduate', 'as' => 'graduate.'], function () {
                Route::get('/', 'GraduateController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'GraduateController@edit')->name('edit');
            });


      Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
                Route::match(['get', 'post'], '/', 'SettingsController@index')->name('index');
            });

            Route::group(['prefix' => 'page', 'as' => 'page.'], function () {
                Route::get('/', 'PageController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'PageController@edit')->name('edit');
            });

            Route::group(['prefix' => 'seo', 'as' => 'seo.'], function () {
                Route::get('/', 'SEOController@index')->name('index');
                Route::match(['get', 'post'], '/edit/{id?}', 'SEOController@edit')->name('edit');
            });


            Route::group(['prefix' => 'search_checkboxes', 'as' => 'search_checkboxes.'], function () {
                //
            });

        });
    });

    Route::get('/', function () {
        return  redirect()->route(auth()->check() ? 'admin.settings.index' : 'admin.login');
    });
});

