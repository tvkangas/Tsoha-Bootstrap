<?php

class tulosController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $tulokset = tulos::all();
        View::make('tulokset/index.html', array('tulokset' => $tulokset));
    }

    public static function show($id) {
        self::check_logged_in();
        $tulos = tulos::find($id);
        View::make('tulokset/show.html', array('tulos' => $tulos));
    }

    public static function create() {
        self::check_logged_in();
        $tulokset = tulos::all();
        $radat = rata::all();
        View::make('tulokset/new.html', array('tulokset' => $tulokset, 'radat' => $radat));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'rata_id' => $params['rata_id'],
            'pelaaja_id' => $params['pelaaja_id'],
            'paivamaara' => $params['paivamaara'],
            'muistiinpanot' => $params['muistiinpanot']
        );
        $tulos = new tulos($attributes);
        $errors = 0;
        //$errors = $tulos->errors();
        $tulos->save();
        Redirect::to('/tulokset', array('message' => 'Tulos lisätty onnistuneesti'));
//        if (count($errors) == 0) {
        //$tulos->save();
        //Redirect::to('/tulokset/' . $tulos->id, array('message' => 'Tulos lisätty onnistuneesti'));
        //} else {
        //View::make('tulokset/new.html', array('errors' => $errors, 'attributes' =>$attributes));
        //}
    }

    public static function edit($id) {
        self::check_logged_in();
        $tulos = tulos::find($id);
        $radat = rata::all();
        View::make('/tulokset/edit.html', array('tulos' => $tulos, 'radat' => $radat));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'rata_id' => $params['rata_id'],
            'pelaaja_id' => $params['pelaaja_id'],
            'paivamaara' => $params['paivamaara'],
            'muistiinpanot' => $params['muistiinpanot']
        );
        $tulos = new tulos($attributes);
        $errors = $tulos->errors();
        if (count($errors) == 0) {
            $tulos->update($id);
            Redirect::to('/tulokset', array('message' => 'Muokkaaminen onnistui.'));
        } else {
            View::make('tulokset/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $tulos = new tulos(array('id' => $id));
        $tulos->destroy($id);
        Redirect::to('/tulokset', array('message' => 'Tulos on poistettu.'));
    }

}
