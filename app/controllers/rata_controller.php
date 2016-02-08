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
    
    public static function create() {
        View::make('radat/new.html');
    }
    
    public static function store() {
        $params = $_POST;
        $rata = new rata(array(
            'nimi'=>$params['nimi'],
            'sijainti'=>$params['sijainti'],
            'luokitus'=>$params['luokitus']
        ));
        $rata->save();
        Redirect::to('/radat/' . $rata->id, array('message' => 'Rata lisätty onnistuneesti'));
    }

}

