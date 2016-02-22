<?php

class pelaajaController extends BaseController {

    public static function index() {
        $pelaajat = pelaaja::all();
        View::make('pelaajat/index.html', array('pelaajat' => $pelaajat));
    }

    public static function login() {
        View::make('etusivu.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $user = pelaaja::authenticate($params['nimi'], $params['password']);

        if (!$user) {
            View::make('etusivu.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/radat', array('message' => 'Tervetuloa' . $user->nimi . '!'));
        }
    }
    
    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/etusivu', array('Olet kirjautunut ulos'));
    }

}
