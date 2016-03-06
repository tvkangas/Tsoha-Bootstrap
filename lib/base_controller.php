<?php

  class BaseController{

    public static function get_user_logged_in(){
      if (isset($_SESSION['user'])){
          $user_id =$_SESSION['user'];
          $user = pelaaja::find($user_id);
          return $user;
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])) {
          Redirect::to('/etusivu', array('message' => 'Kirjaudu sisään'));
      }
    }
    
    public static function get_is_admin() {
        return is_admin();
    }
    
    public static function is_admin() {
        $pelaaja == Pelaaja::find($_SESSION['user']);
        return $pelaaja->admin;
    }

  }
