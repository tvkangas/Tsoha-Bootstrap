<?php

class pelaajaController extends BaseController {

    public static function index() {
        $pelaaja = pelaaja::etsiKirjautunutPelaaja();
        View::make('pelaajat/index.html', array('pelaaja' => $pelaaja));
    }

    public static function rekisteroi() {
        View::make('pelaajat/rekisterointi.html');
    }

    public static function login() {
        View::make('pelaajat/login.html');
    }
    
    public static function kaikki() {
        $pelaajat = pelaaja::allEiAdmin();
        View::make('pelaajat/kaikki.html', array('pelaajat' => $pelaajat));
    }

    public static function handle_login() {
        $params = $_POST;
        $user = pelaaja::authenticate($params['nimi'], $params['password']);

        if (!$user) {
            View::make('pelaajat/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'nimi' => $params['nimi']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/radat', array('message' => 'Tervetuloa' . $user->nimi . '!'));
        }
    }

    //muokkauslomakes
    public static function edit($id) {
        self::check_logged_in();
        $pelaaja = pelaaja::find($id);
        View::make('/pelaajat/edit.html', array('pelaaja' => $pelaaja));
    }

    public static function update($id) {
        $params = $_POST;
        $nimi = pelaaja::haePelaajannimi($id);
        $attributes = array(
            'id' => $id,
            'nimi' => $nimi,
            'password' => $params['password']
        );
        $pelaaja = new pelaaja($attributes);
        if ((strcmp($params['password'], $params['passwordvahvistus']) ==0) && (strlen($params['password']) >= 5)) {
           $pelaaja->update($id);
           Redirect::to('/etusivu', array('message' => 'Salasanan muokkaus onnistui.')); 
        } else {
            View::make('pelaajat/edit.html', array('pelaaja' => $pelaaja));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/etusivu', array('Olet kirjautunut ulos'));
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'password' => $params['password'],
            'passwordvahvistus' => $params['passwordvahvistus']
        );
        $pelaaja = new pelaaja($attributes);
        $errors = $pelaaja->errors();
        if (count($errors) == 0) {
            $pelaaja->save();
            Redirect::to('/login', array('message' => 'Rekisteröinti onnistui'));
        } else {
            View::make('pelaajat/rekisterointi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function destroy($id) {
        $pelaaja = new pelaaja(array('id' => $id));
        $pelaaja->destroy($id);
        Redirect::to('/kayttajat', array('message' => 'Pelaaja on poistettu.'));
    }

}
