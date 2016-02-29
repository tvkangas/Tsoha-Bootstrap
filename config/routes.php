<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/etusivu', function() {
    HelloWorldController::login();
  });  
  
  //$routes->get('/radat', function() {
   // HelloWorldController::radat();
  //});  
  
  $routes->get('/tuloslisays', function() {
    HelloWorldController::tuloslisays();
  }); 
  
  $routes->get('/tuloslistaus', function() {
    HelloWorldController::tuloslistaus();
  }); 
  

  //$routes->get('/radanlisays', function() {
    //HelloWorldController::radanlisays();
  //}); 

  $routes->get('/radanlisays', function() {
    HelloWorldController::radanlisays();
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
  