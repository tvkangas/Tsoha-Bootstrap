<?php

class rata extends BaseModel {

    public $id, $nimi, $sijainti, $luokitus, $parastulos, $par, $pelaajaId , $paivamaara, $pelaajanimi, $heittomaara;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_sijainti');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Rata');
        $query->execute();
        $rows = $query->fetchAll();
        $radat = array();
        $parasTulos = 0;

        foreach ($rows as $row) {
            //$tulokset = tulos::etsiRadalla($row['id']);
            //foreach ($tulokset as $tulos) {
                //$par = $tulos->par;
                //$parasTulos = $tulos->paras;
            //}
            $par = rata::laskePar($row['id']);
            $radat[] = new rata(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'sijainti' => $row['sijainti'],
                'luokitus' => $row['luokitus'],
                'par' => $par,
            ));
        }
        return $radat;
    }

    public static function find($rataid) {
        $query = DB::connection()->prepare('SELECT * FROM Rata WHERE id = :rataid LIMIT 1');
        $query->execute(array('rataid' => $rataid));
        $row = $query->fetch();
        $parastulos = tulos::etsiRadanParasTulos($rataid);
        //$pelaajanimi = $parastulos->pelaajanimi;
        $par = rata::laskePar($row['id']);
        if ($row) {
            $rata = new rata(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'sijainti' => $row['sijainti'],
                'luokitus' => $row['luokitus'],
                'par' => $par,
                'heittomaara' => $parastulos['heittomaara'],
                'pelaajanimi' => $parastulos['pelaajanimi'],
                'paivamaara' => $parastulos['paivamaara']                
            ));
            return $rata;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Rata (nimi, sijainti, luokitus) VALUES (:nimi, :sijainti, :luokitus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'sijainti' => $this->sijainti, 'luokitus' => $this->luokitus));
        $row = $query->fetch();
        $this->id = $row['id'];
        return $this->id;
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Rata set nimi = :nimi, sijainti = :sijainti, luokitus = :luokitus WHERE id =:id');
        $query->execute(array('nimi' => $this->nimi, 'sijainti' => $this->sijainti, 'luokitus' => $this->luokitus, 'id' => $id));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Rata WHERE id=:id');
        $query->execute(array('id' => $id));
    }
    
    public static function laskePar($rataid) {
        $query = DB::connection()->prepare('SELECT sum(par) AS partulos FROM Rata
        LEFT JOIN Vayla ON Vayla.rataId = Rata.id
        WHERE Rata.id = :rataid;');
        $query->execute(array('rataid' => $rataid));
        $row = $query->fetch();
        $par = $row['partulos'];
        return $par;
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä.';
        }
        if (strlen($this->nimi) < 2) {
            $errors[] = 'Nimen pituuden tulee olla vähintään 2 merkkiä.';
        }
        return $errors;
    }

    public function validate_sijainti() {
        $errors = array();
        if ($this->sijainti == '' || $this->sijainti == null) {
            $errors[] = 'Sijainti ei saa olla tyhjä.';
        }
        if (strlen($this->sijainti) < 2) {
            $errors[] = 'Sijainnin pituuden tulee olla vähintään 2 merkkiä.';
        }
        if (is_numeric($this->sijainti)) {
            $errors[] = 'Sijainti ei saa olla numero';
        }
        return $errors;
    }

}
