<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

define('PAGINATION_COUNT', 9);

Auth::routes();
Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/getdata', 'HomeController@getData')->name('home.getdata');
    Route::get('/offreDetail/{id}', 'HomeController@detailOffre')->name('offre.detail');
    Route::get('/offre', 'HomeController@chercherOffre')->name('offre.cherche');
    Route::post('/offre', 'HomeController@offreCharge')->name('offre.charge');
    Route::get('/categorie', 'HomeController@all')->name('offre.all');
    Route::get('/categorie-offre/{slug}', 'HomeController@categorieOffre')->name('offre.categorie');
    Route::Post('/demande', 'DemandeController@store')->name('demande.store');
    //    Route::get('/feedback', 'HomeController@feedback')->name('client.avis');
    Route::get('/valider/{id}', 'DemandeController@sendEmailToClient')->name('client.paiement');
    Route::get('/paiement/{id}/{offredetail}', 'DemandeController@paiement')->name('paiement');
    Route::get('/avis/{id}/{offredetail}', 'DemandeController@avisClient')->name('client.avis');
    Route::post('/avis', 'DemandeController@saveAviClient')->name('client.avis');
    Route::POST('/paiement', 'DemandeController@charge')->name('paiement');
    Route::get('/validation', 'DemandeController@validation')->name('offre.valider');
    Route::get('/validation-reservation', 'DemandeController@validation2')->name('offre.valider2');
    Route::get('/getdesination', 'HomeController@getOffreAjax')->name('offre.destination');
    Route::get('/getprix', 'HomeController@getPrixAjax')->name('home.getPrix');
    Route::get('/getvehicule', 'HomeController@getVehicule')->name('home.getVehicule');


    Route::POST('/Contact', 'ContactController@receveEmail')->name('contact');
    //    Route::post('/offre', 'HomeController@chauffeurConnexion')->name('offre.charge');
});
Route::group(['namespace' => 'Admin'], function () {
    Route::get('/chauffeur', 'ChauffeurController@demadeInscription')->name('chauffeur.demande');
    Route::post('/chauffeur', 'ChauffeurController@enregistreDemande')->name('chauffeur.save');
    Route::post('/connexion', 'ChauffeurController@connexion')->name('chauffeur.connexion');
    Route::Get('/Deconnecter', 'ChauffeurController@deconnecter')->name('chauffeur.deconnecter');
    Route::group(['middleware' => 'authChauffeur'], function () {
        Route::Get('/EspaceChuffeur', 'ChauffeurController@espaceChaufeur')->name('chauffeur.espace');
        Route::Get('/commencer', 'ChauffeurController@commencer')->name('chauffeur.commence');
        Route::Get('/terminer', 'ChauffeurController@terminer')->name('chauffeur.terminer');
    });

    //
    //

});
