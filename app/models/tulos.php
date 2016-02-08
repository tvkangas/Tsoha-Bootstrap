<?php

class tulos extends BaseModel {

    public $id, $rata_id, $pelaaja_id, $paivamaara, $muistiinpanot;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tulos');
        $query->execute();
        $rows = $query->fetchAll();
        $tulokset = array();

        foreach ($rows as $row) {
            $tulokset[] = new tulos(array(
            'id' => $row['id'],
            'rata_id' => $row['rata_id'],
            'pelaaja_id' => $row['pelaaja_id'],
            'paivamaara' => $row['paivamaara'],
            'muistiinpanot' => $row['muistiinpanot']
            ));
        }
        return $tulokset;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tulos WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $tulos = new tulos(array(
            'id' => $row['id'],
            'rata_id' => $row['rata_id'],
            'pelaaja_id' => $row['pelaaja_id'],
            'paivamaara' => $row['paivamaara'],
            'muistiinpanot' => $row['muistiinpanot']
            ));
            return $tulos;
        }
        return null;
    }
}

