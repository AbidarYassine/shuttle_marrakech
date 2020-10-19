<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin')->name('admin.get.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
});
#################### end route admin  login######################
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::post('/', 'DashboardController@statistique')->name('admin.statistique');
    ####################### start route offre ##############
    Route::group(['prefix' => 'offre'], function () {
        Route::get('/', 'OffreController@index')->name('admin.offres');
        Route::get('/create', 'OffreController@create')->name('admin.offres.create');
        Route::get('/show/{slug}', 'OffreController@show')->name('admin.offres.show');
        Route::post('/store', 'OffreController@store')->name('admin.offres.store');
        Route::get('/edit/{id}', 'OffreController@edit')->name('admin.offres.edit');
        Route::post('/update/{id}', 'OffreController@update')->name('admin.offres.update');
        Route::get('/delete/{id}', 'OffreController@destroy')->name('admin.offres.delete');
    });
    #################### end route offre###########
    ####################### start route Catrgorie ##############
    Route::group(['prefix' => 'categorie'], function () {
        Route::get('/', 'CategorieController@index')->name('admin.categories');
        Route::get('/create', 'CategorieController@create')->name('admin.categories.create');
        Route::post('/store', 'CategorieController@store')->name('admin.categories.store');
        Route::get('/edit/{slug}', 'CategorieController@edit')->name('admin.categories.edit');
        Route::post('/update/{slug}', 'CategorieController@update')->name('admin.categories.update');
        Route::get('/delete/{slug}', 'CategorieController@destroy')->name('admin.categories.delete');
    });
    Route::group(['prefix' => 'offreDetail'], function () {
        Route::get('/', 'OffreDetaiController@index')->name('admin.offreDetail');
        Route::get('/create', 'OffreDetaiController@create')->name('admin.offreDetail.create');
        Route::post('/store', 'OffreDetaiController@store')->name('admin.offreDetail.store');
        Route::get('/edit/{slug}', 'OffreDetaiController@edit')->name('admin.offreDetail.edit');
        Route::post('/update/{slug}', 'OffreDetaiController@update')->name('admin.offreDetail.update');
        Route::get('/delete/{slug}', 'OffreDetaiController@destroy')->name('admin.offreDetail.delete');
        Route::get('/terminer', 'OffreDetaiController@terminer')->name('admin.offreDetail.terminer');
        Route::get('/affecter/{id}', 'OffreDetaiController@affecter')->name('admin.offreDetail.affecter');
        Route::get('/prix', 'OffreDetaiController@definitPrix')->name('admin.offreDetail.prix');
        Route::get('/show/{id}', 'OffreDetaiController@show')->name('admin.offreDetail.show');
        Route::get('/affecter/{id_chauffeur}/{id_offre}/{idOffreDet}', 'OffreDetaiController@affecterChauffeur')->name('admin.offreDetail.affecterChauffeur');
    });
    #################### end route Catrgorie ###########
    ####################### start route chauffeur##########
    Route::group(['prefix' => 'chauffeur'], function () {
        Route::get('/', 'ChauffeurController@index')->name('admin.chauffeur');
        Route::get('/create', 'ChauffeurController@create')->name('admin.chauffeur.create');
        Route::get('/demande', 'ChauffeurController@getAlldemande')->name('admin.chauffeur.demande');
        Route::post('/store', 'ChauffeurController@store')->name('admin.chauffeur.store');
        Route::get('/edit/{id}', 'ChauffeurController@edit')->name('admin.chauffeur.edit');
        Route::post('/update/{id}', 'ChauffeurController@update')->name('admin.chauffeur.update');
        Route::get('/delete/{id}', 'ChauffeurController@destroy')->name('admin.chauffeur.delete');
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index')->name('admin.profile');
        Route::post('/update/{id}', 'AdminController@update')->name('admin.update');
    });

    ####################### end route chauffeur##########

    Route::group(['prefix' => 'vehicule'], function () {
        Route::get('/', 'VehiculeController@index')->name('admin.vehicule');
        Route::get('/create', 'VehiculeController@create')->name('admin.vehicule.create');
        Route::post('/store', 'VehiculeController@store')->name('admin.vehicule.store');
        Route::get('/edit/{id}', 'VehiculeController@edit')->name('admin.vehicule.edit');
        Route::post('/update/{id}', 'VehiculeController@update')->name('admin.vehicule.update');
        Route::get('/delete/{id}', 'VehiculeController@destroy')->name('admin.vehicule.delete');
    });
    ############end route viecule##########

    //
});
Route::group(['prefix' => 'reservation', 'namespace' => 'Site'], function () {
    Route::get('/', 'DemandeController@index')->name('admin.reservation');
    Route::POST('/prix', 'DemandeController@updatePrix')->name('reservation.prix');
});
