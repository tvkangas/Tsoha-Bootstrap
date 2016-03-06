<?php

  $routes->get('/', function() {
    etusivuController::index();
  });
  
  $routes->get('/etusivu', function() {
    etusivuController::index();
  });  
  
  $routes->get('/radat', function() {
    rataController::index();
  });  
   
  //radan lisääminen tietokantaan
  $routes->post('/radat', function(){
    rataController::store();
  });
  
  //lisäyslomake (rata)
  $routes->get('/radat/new', function(){
     rataController::create();
  });

  //radan esittely
  $routes->get('/radat/:id', function($id){
      rataController::show($id);
  });
  
  //radan muokkaus
  $routes->get('/radat/:id/edit', function($id) {
      rataController::edit($id);
  });
  
  //radan päivitys
  $routes->post('/radat/:id/edit', function($id)  {
      rataController::update($id);
  });
  
  //radan poisto
  $routes->post('/rata/:id/destroy', function($id) {
      rataController::destroy($id);
  });  
  
  $routes->get('/tulokset', function() {
    tulosController::index();
  });  
   
  //tuloksen lisääminen tietokantaan
  $routes->post('/tulokset', function(){
    tulosController::store();
  });
  
  //lisäyslomake (tulos)
  $routes->get('/tulokset/new', function(){
     tulosController::create();
  });

  //tuloksen esittely
  $routes->get('/tulokset/:id', function($id){
      tulosController::show($id);
  });
  
  //tuloksen muokkaus
  $routes->get('/tulokset/:id/edit', function($id) {
      tulosController::edit($id);
  });
  
  //tuloksen päivitys
  $routes->post('/tulokset/:id/edit', function($id)  {
      tulosController::update($id);
  });
  
  //tuloksen poisto
  $routes->post('/tulokset/:id/destroy', function($id) {
      tulosController::destroy($id);
  });
  
  //kirjautuminen
  $routes->get('/login', function() {
      pelaajaController::login();
  });
  
  //kirjautuminen
  $routes->post('/login', function() {
      pelaajaController::handle_login();
  });
  
  $routes->post('/logout', function() {
    pelaajaController::logout();
  });
  
  $routes->get('/rekisterointi', function() {
    pelaajaController::rekisteroi();
  });
  
  $routes->post('/rekisterointi', function() {
    pelaajaController::store();
  });
  
  $routes->get('/pelaaja', function() {
    pelaajaController::index();
  });
  
  //pelaajan muokkaus
  $routes->get('/pelaaja/:id/edit', function($id) {
      pelaajaController::edit($id);
  });
  
  $routes->post('/pelaaja/:id/edit', function($id) {
      pelaajaController::update($id);
  });
  
  $routes->get('/kayttajat', function() {
    pelaajaController::kaikki();
  });  
  
  $routes->post('/kayttajat', function() {
    pelaajaController::kaikki();
  }); 
  
  $routes->post('/pelaaja/:id/destroy', function($id) {
      pelaajaController::destroy($id);
  });
  