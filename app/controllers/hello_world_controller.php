<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('etusivu.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/etusivu.html');
    }
    
    public static function radat() {
        View::make('suunnitelmat/ratojenlistaus.html');
    }
    
    public static function tuloslisays() {
        View::make('suunnitelmat/tuloksenlisays.html');
    }
    
    public static function tuloslistaus() {
        View::make('suunnitelmat/tuloksienlistaus.html');
    }
    
    public static function radanlisays() {
        View::make('suunnitelmat/radanlisays.html');
    }
  }
