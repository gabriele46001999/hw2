<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
   return redirect('/home');
});

//SIGNIFICA public/
//ROUTE PER GESTIRE LOGIN/REGISTER/SESSIONE
Route::get('/register','ControllerRegister@RegisterGet');
Route::post('/register','ControllerRegister@RegisterPost');
Route::get('/logout','ControllerLogin@logout');
Route::get('/login','ControllerLogin@LoginGet');
Route::post('/login','ControllerLogin@LoginPost');
Route::get('/ajax_checkEmail/{paramEmail}','ControllerRegister@check_Email');
Route::get('/ajax_checkUsername/{paramUsername}','ControllerRegister@check_Username');
Route::get('/check_sessione','ControllerLogin@checkSessione');
//ROUTE CHE GESTISCONO PAGINE//
Route::get('/home','ControllerHome@HomeGet');
Route::get('/Computer','ControllerProduct@ComputerGet');
Route::get('/Smartphone','ControllerProduct@SmartphoneGet');
Route::get('/Accessori','ControllerProduct@AccessoriGet');
Route::get('/ajax_AggiornaProdotti/{tipologia}','ControllerProduct@AggiornaProdotti');
Route::get('/ajax_dbpreferitishow/{tipologia}','ControllerProduct@AggiornaPreferiti');
Route::get('/ajax_dbInsertpreferiti/{id_prodotto}','ControllerProduct@InserisciPreferiti');
Route::get('/ajax_dbremovePreferiti/{id_prodotto}','ControllerProduct@RimuoviPreferiti');
Route::get('/ajax_dbShowProdotto/{id_prodotto}','ControllerProduct@ShowProduct');
Route::get('/ajax_dbsearchbar/{tipologia}/{filtro}','ControllerProduct@searchBar');
//ROUTE CHE GESTISCONO LE API REST//
Route::get('/ajax_apiGET/{pagina}','ControllerApiRest@apiGet');
Route::get('ajax_apiPostRequestToken','ControllerApiRest@RequestToken');
Route::get('ajax_apiOauth/{access_token}/{tipologia}','ControllerApiRest@apiOauth');
//ROUTE CHE GESTISCONO IL CARRELLO//
Route::get('/Carrello','ControllerCarrello@CarrelloGet');
Route::get('/ajax_dbInsertCarrello/{id_prodotto}/{quantita}','ControllerCarrello@InserisciCarrello');
Route::get('/ajax_dbShowcarrello','ControllerCarrello@VisualizzaProdotti');
Route::get('/ajax_dbRemoveItemCarrello/{id_prodtto}','ControllerCarrello@EliminaProdotto');
Route::get('/ajax_dbDecQuantitaCarrello/{id_prodotto}','ControllerCarrello@DecQuantitaProdotto');
Route::get('/ajax_dbAddQuantitaCarrello/{id_prodotto}','ControllerCarrello@AggQuantitaProdotto');
Route::get('/ajax_dbAcquistaCarrello','ControllerCarrello@AcquistaCarrello');
//ROUTE CHE GESTISCE LA PAGINA ACQUISTI//
Route::get('/Acquisti','ControllerAcquisti@AcquistiGet');
Route::get('/ajax_dbshowAcquisti','ControllerAcquisti@MostraAcquisti');

