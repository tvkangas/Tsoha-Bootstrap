<?php

class rataController extends BaseController {

    public static function index() {
        $radat = rata::all();
        View::make('radat/index.html', array('radat' => $radat));
    }

    public static function show($id) {
        $rata = rata::find($id);
        View::make('radat/show.html', array('rata' => $rata));
    }

    public static function create() {
        View::make('radat/new.html');
    }

    public static function store() {
        $params = $_POST;        
        $attributes = array(
            'nimi' => $params['nimi'],
            'sijainti' => $params['sijainti'],
            'luokitus' => $params['luokitus']
        );
        $rata = new rata($attributes);
        $errors = $rata->errors();
        if (count($errors) == 0) {
            $rata->save();
            Redirect::to('/radat/' . $rata->id, array('message' => 'Rata lisätty onnistuneesti'));
        } else {
            View::make('radat/new.html', array('errors' => $errors, 'attributes' =>$attributes));
        }
    }

    //muokkauslomake
    public static function edit($id) {
        self::check_logged_in();
        $rata = rata::find($id);
        View::make('/radat/edit.html', array('rata' => $rata));
    }

    // radan päivitys
    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'sijainti' => $params['sijainti'],
            'luokitus' => $params['luokitus']
        );
        $rata = new rata($attributes);
        //Virhekäsittely puuttuu
        $rata->update($id);
        Redirect::to('/radat', array('message' => 'Muokkaaminen onnistui.'));
    }

    //Poisto
    public static function destroy($id) {
        self::check_logged_in();
        $rata = new rata(array('id' => $id));
        $rata->destroy($id);
        Redirect::to('/radat', array('message' => 'Rata on poistettu.'));
    }

}
