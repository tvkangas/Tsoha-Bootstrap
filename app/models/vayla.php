<?php

class vayla extends BaseModel {

    public $id, $rataid, $par, $numero;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    //lkm kertoo kuinka monta vaylaa pitää luoda. 
    //Default arvo parille on 3    
    public function save($lkm, $rataid) {
        for ($laskuri = 1; $laskuri <= $lkm; $laskuri++) {
            $query = DB::connection()->prepare('INSERT INTO Vayla (rataid, numero) VALUES (:rataid, :numero)');
            $query->execute(array('rataid' => $rataid, 'numero' => $laskuri));
        }
    }

    public function tallennaParilla($rataid, $par, $numero) {
        $query = DB::connection()->prepare('INSERT INTO Vayla (rataid, par, numero) VALUES (:rataid, :par, :numero)');
        $query->execute(array('rataid' => $rataid, 'par' => $par, 'numero' => $numero));
    }

    //Päivitys (par-tuloksia varten)
    public function update($rataid, $par, $numero) {
        $query = DB::connection()->prepare('UPDATE Vayla SET par = :par WHERE rataId = :rataid AND numero = :numero');
        $query->execute(array('rataid' => $rataid, 'par' => $par, 'numero' => $numero));
    }

    //Poisto
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Vayla WHERE id=:id');
        $query->execute(array('id' => $id));
    }

    public static function etsiRadalla($rataId) {
        $query = DB::connection()->prepare('SELECT * FROM Vayla WHERE rataId = :rataId ORDER BY numero');
        $query->execute(array('rataId' => $rataId));
        $rows = $query->fetchAll();
        $vaylat = array();
        foreach ($rows as $row) {
            $vaylat[] = new vayla(array(
                'id' => $row['id'],
                'rataId' => $row['rataId'],
                'par' => $row['par'],
                'numero' => $row['numero']
            ));
        }
        return $vaylat;
    }

    public static function etsiRadallaJaNumerolla($rataid, $numero) {
        $query = DB::connection()->prepare('SELECT * FROM Vayla WHERE rataid = :rataid AND numero = :numero LIMIT 1');
        $query->execute(array('rataid' => $rataid, 'numero' => $numero));
        $row = $query->fetch();
        $vayla = new vayla(array(
            'id' => $row['id'],
            'rataid' => $row['rataid'],
            'par' => $row['par'],
            'numero' => $row['numero']
        ));
        return $vayla;
    }
    

}
