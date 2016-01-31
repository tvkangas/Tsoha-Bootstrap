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
  
  $routes->get('/radat', function() {
    HelloWorldController::radat();
  });  
  
  $routes->get('/tuloslisays', function() {
    HelloWorldController::tuloslisays();
  }); 
  
  $routes->get('/tuloslistaus', function() {
    HelloWorldController::tuloslistaus();
  }); 
  
  $routes->get('/radanlisays', function() {
    HelloWorldController::radanlisays();
  }); 
