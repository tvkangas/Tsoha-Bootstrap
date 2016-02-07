<?php

class rataController extends BaseController{
    public static function index() {
        $radat = rata::all();
        View::make('radat/index.html', array('radat' => $radat));
    }
    
    public static function show($id) {
        $rata = rata::find($id);
        View::make('radat/show.html', array('rata' =>$rata));
    }
    
}

