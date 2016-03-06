<?php

class vaylatulos extends BaseModel {

    public $tulosid, $vaylaid, $heitot;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    //public function save($tulosid, $vaylaid, $heitot) {
        
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO VaylaTulos (tulosId, vaylaId, heitot) VALUES (:tulosid, :vaylaid, :heitot)');
        $query->execute(array('tulosid' => $this->tulosid, 'vaylaid' => $this->vaylaid, 'heitot' => $this->heitot));
    }
    
    public function update($tulosid, $vaylaid, $heitot) {
        $query = DB::connection()->prepare('UPDATE VaylaTulos set heitot = :heitot WHERE tulosId = :tulosid AND vaylaId = :vaylaid');
        $query->execute(array('tulosid' => $tulosid, 'vaylaid' => $vaylaid, 'heitot' => $heitot));
    }
    
    public function haeHeitotTuloksellaJaVaylalla($tulosid, $vaylaid) {
        $query = DB::connection()->prepare('SELECT * FROM VaylaTulos WHERE tulosId = :tulosid AND vaylaId = :vaylaid LIMIT 1');
        $query->execute(array('tulosId' => $tulosid, 'vaylaId' => $vaylaid));
        $row = $query->fetch();
        $vaylatulos = new vaylatulos(array(
            'tulosid' => $row['tulosid'],
            'vaylaid' => $row['vaylaid'],
            'heitot' => $row['heitot']
        ));
    }
    
}

