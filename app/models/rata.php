<?php

class rata extends BaseModel {

    public $id, $nimi, $sijainti, $luokitus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Rata');
        $query->execute();
        $rows = $query->fetchAll();
        $radat = array();

        foreach ($rows as $row) {
            $radat[] = new rata(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'sijainti' => $row['sijainti'],
                'luokitus' => $row['luokitus']
            ));
        }
        return $radat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Rata WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $rata = new rata(array(
            'id' => $row['id'],
            'nimi' => $row['nimi'],
            'sijainti' => $row['sijainti'],
            'luokitus' => $row['luokitus']
            ));
            return $rata;
        }
        return null;
    }
<<<<<<< HEAD
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Rata (nimi, sijainti, luokitus) VALUES (:nimi, :sijainti, :luokitus) RETURNING id');
        $query->execute(array('nimi'=>$this->nimi, 'sijainti'=>$this->sijainti, 'luokitus'=>$this->luokitus));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
=======
>>>>>>> 81d03ef0e73871e941e3e0c00d3193d0adec4b7d

}
