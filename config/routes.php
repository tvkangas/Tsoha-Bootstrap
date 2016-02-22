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
  