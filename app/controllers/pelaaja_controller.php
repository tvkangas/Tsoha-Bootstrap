<?php

class pelaajaController extends BaseController{
    public static function index() {
        $pelaajat = pelaaja::all();
        View::make('pelaajat/index.html', array('pelaajat' => $pelaajat));
    }
    
}

