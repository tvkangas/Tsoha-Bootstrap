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
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tulos (rata_id, pelaaja_id, paivamaara, muistiinpanot) VALUES (:rata_id, :pelaaja_id, :paivamaara, :muistiinpanot');
        $query->execute(array('rata_id'=>$this->rata_id, 'pelaaja_id'=>$this->pelaaja_id, 'paivamaara'=>$this->paivamaara, 'muistiinpanot'=>$this->muistiinpanot));
        $row = $query->fetch();
        $this->id = $row['id'];
        return $this->id;
    }

    public function update($id){
        $query = DB::connection()->prepare('UPDATE Tulos set rata_id = :rata_id, pelaaja_id = :pelaaja_id, paivamaara = :paivamaara, muistiinpanot = :muistiinpanot WHERE id =:id');
        $query->execute(array('nimi'=>$this->nimi, 'sijainti'=>$this->sijainti, 'luokitus'=>$this->luokitus, 'id'=>$id));
    }
    
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM Tulos WHERE id=:id');
        $query->execute(array('id'=>$id));
    }
}

