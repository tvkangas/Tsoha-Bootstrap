<?php

class vayla extends BaseModel {

    public $id, $rataId, $par, $numero;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    //lkm kertoo kuinka monta vaylaa pitää luoda. 
    //Default arvo parille on 3    
    public function save($lkm, $rataId) {
        for ($laskuri=1; $laskuri <= $lkm; $laskuri++) {
            $query = DB::connection()->prepare('INSERT INTO Vayla (rataId, numero) VALUES (:rataId, :numero)');
            $query->execute(array('rataId' => $rataId, 'numero' => $laskuri));
        }
    }
    
    //Päivitys (par-tuloksia varten)
    public function update() {
        $query = DB::connection()->prepare('UPDATE Vayla SET par = :par WHERE id = :id');
        $query->execute(array('par'=>$this->par, 'id'=>$this->id));
    }
    
    //Poisto
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM Vayla WHERE id=:id');
        $query->execute(array('id'=>$id));
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

    public static function etsiRadallaJaNumerolla($rataId, $numero) {
        $query = DB::connection()->prepare('SELECT * FROM Vayla WHERE rataId = :rataId AND numero = :numero LIMIT 1');
        $query->execute(array('rataId' => $rataId, 'numero' => $numero));
        $row = $query->fetch();
        $vayla = new vayla(array(
            'id' => $row['id'],
            'rataId' => $row['rataId'],
            'par' => $row['par'],
            'numero' => $row['numero']
        ));
        return $vayla;
    }
    
    

}