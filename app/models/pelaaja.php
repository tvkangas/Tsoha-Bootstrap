<?php

class pelaaja extends BaseModel {

    public $id, $nimi, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja');
        $query->execute();
        $rows = $query->fetchAll();
        $pelaajat = array();

        foreach ($rows as $row) {
            $pelaajat[] = new pelaaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
            ));
        }
        return $pelaajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $pelaaja = new pelaaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
            ));
            return $pelaaja;
        }
        return null;
    }

}
