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
        $pelaajaid = $_SESSION['user'];
        $attributes = array(
            'rataid' => $params['rataid'],
            'pelaajaid' => $pelaajaid,
            'paivamaara' => $params['paivamaara'],
            'muistiinpanot' => $params['muistiinpanot']
        );
        $tulos = new tulos($attributes);
        $tulos->save();
        $tulosid = $tulos->id;
        self::lisaaVaylatulokset($params, $tulosid);
        Redirect::to('/tulokset', array('message' => 'Tulos lisätty onnistuneesti'));
    }

    public static function lisaaVaylatulokset($params, $tulosid) {
        $rataid = $params['rataid'];
        $tulosid = $tulosid;
        for ($laskuri = 1; $laskuri <= 18; $laskuri++) {
            $str = 'vayla' . $laskuri;
            $tulos = $params[$str];
            $vayla = vayla::etsiRadallaJaNumerolla($rataid, $laskuri);
            $vaylaid = $vayla->id;
            $attributes = array(
                'tulosid' => $tulosid,
                'vaylaid' => $vaylaid,
                'heitot' => $tulos
            );
            $vaylatulos = new vaylatulos($attributes);
            $vaylatulos->save();
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $tulos = tulos::find($id);
        $radat = rata::all();
        $tulokset = tulos::haeTuloksenVaylatulokset($id);
        View::make('/tulokset/edit.html', array('tulos' => $tulos, 'radat' => $radat, 'tulokset' => $radat));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $pelaajaid = $_SESSION['user'];
        $attributes = array(
            'id' => $id,
            'rataid' => $params['rataid'],
            'pelaajaid' => $pelaajaid,
            'paivamaara' => $params['paivamaara'],
            'muistiinpanot' => $params['muistiinpanot']
        );
        $tulos = new tulos($attributes);
        //$errors = $tulos->errors();
        //if (count($errors) == 0) {
        $tulos->update($id);
        self::paivitaVaylatulokset($params, $id);
        Redirect::to('/tulokset', array('message' => 'Muokkaaminen onnistui.'));
        //} else {
            //View::make('tulokset', array('errors' => $errors, 'attributes' => $attributes));
        //}
    }

    public static function paivitaVaylatulokset($params, $tulosid) {
        $rataid = $params['rataid'];
        $tulosid = $tulosid;
        for ($laskuri = 1; $laskuri <= 18; $laskuri++) {
            $str = 'vayla' . $laskuri;
            $tulos = $params[$str];
            $vayla = vayla::etsiRadallaJaNumerolla($rataid, $laskuri);
            $vaylaid = $vayla->id;
            $attributes = array(
                'tulosid' => $tulosid,
                'vaylaid' => $vaylaid,
                'heitot' => $tulos
            );
            $vaylatulos = new vaylatulos($attributes);
            $vaylatulos->update($tulosid, $vaylaid, $tulos);
        }

        for ($laskuri = 1; $laskuri <= 18; $laskuri++) {
            $str = 'vayla' . $laskuri;
            $tulos = $params[$str];
            $vayla = vayla::etsiRadallaJaNumerolla($rataid, $laskuri);
            $vaylaid = $vayla->id;
            $attributes = array(
                'tulosid' => $tulosid,
                'vaylaid' => $vaylaid,
                'heitot' => $tulos
            );
            $vaylatulos = new vaylatulos($attributes);
            $vaylatulos->save();
        }

        for ($laskuri = 1; $laskuri <= 18; $laskuri++) {
            $str = 'vayla' . $laskuri;
            $par = $params[$str];
            $attributes = array(
                'rataid' => $rataid,
                'par' => $params[$str],
                'numero' => $laskuri
            );
            $vayla = new vayla($attributes);
            $vayla->update($rataid, $par, $laskuri);
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $tulos = new tulos(array('id' => $id));
        $tulos->destroy($id);
        Redirect::to('/tulokset', array('message' => 'Tulos on poistettu.'));
    }

}
