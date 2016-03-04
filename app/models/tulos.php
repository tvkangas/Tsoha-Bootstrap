<?php

class tulos extends BaseModel {

    public $id, $tulosid, $rataid, $pelaajaid, $paivamaara, $muistiinpanot, $par, $heittomaara, $paras, $ratanimi, $pelaajanimi, $paraspelaaja;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_pvm', 'validate_muistiinpanot');
    }

    public static function all() {
        $pelaajaid = $_SESSION['user'];
        $query = DB::connection()->prepare('SELECT Tulos.id AS tulosid, Tulos.rataId AS rataid, Tulos.paivamaara AS paivamaara, Tulos.muistiinpanot AS muistiinpanot, Rata.nimi AS ratanimi FROM Tulos
        LEFT JOIN Rata ON Tulos.rataid = Rata.id
        WHERE Tulos.pelaajaid =:pelaajaid;');
        $query->execute(array('pelaajaid' => $pelaajaid));
        $rows = $query->fetchAll();
        $tulokset = array();

        foreach ($rows as $row) {
            $heittomaara = self::laskeKokonaistulos($row['tulosid']);
            $par = rata::laskePar($row['rataid']);

            $tulokset[] = new tulos(array(
                'tulosid' => $row['tulosid'],
                'rataid' => $row['rataid'],
                'ratanimi' => $row['ratanimi'],
                'paivamaara' => $row['paivamaara'],
                'muistiinpanot' => $row['muistiinpanot'],
                'heittomaara' => $heittomaara,
                'par' => $par
            ));
        }
        return $tulokset;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT Tulos.id AS tulosid, Tulos.rataId AS rataid, Tulos.paivamaara AS paivamaara, Tulos.muistiinpanot AS muistiinpanot, Rata.nimi AS ratanimi FROM Tulos
        LEFT JOIN Rata ON Tulos.rataid = Rata.id
        WHERE Tulos.id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $heittomaara = self::laskeKokonaistulos($row['tulosid']);
        $par = rata::laskePar($row['rataid']);

        if ($row) {
            $tulos = new tulos(array(
                'tulosid' => $row['tulosid'],
                'paivamaara' => $row['paivamaara'],
                'muistiinpanot' => $row['muistiinpanot'],
                'ratanimi' => $row['ratanimi'],
                'heittomaara' => $heittomaara,
                'par' => $par
            ));
            return $tulos;
        }
        return null;
    }
    
    //SQL-kysely hakee kaikkki tulokset, järjestää ne nousevaan järjestykseen.
    //Tällöin paras tulos on ensimmäisenä, jolloin LIMIT-parametrilla saadaan
    //vain yksi tulos.
    public static function etsiRadanParasTulos($rataid) {
        $query = DB::connection()->prepare('SELECT Tulos.id AS tulosid, Pelaaja.nimi AS pelaajanimi, sum(vt.heitot) AS heittomaara, Tulos.paivamaara AS paivamaara FROM Tulos 
        JOIN VaylaTulos vt ON vt.TulosId = Tulos.id
        JOIN Pelaaja ON Tulos.pelaajaid = Pelaaja.id
        WHERE Tulos.rataid = :rataid
        GROUP BY Tulos.id, Pelaaja.nimi, Tulos.paivamaara
        ORDER BY heittomaara ASC
        LIMIT 1');
        $query->execute(array('rataid' => $rataid));
        $row = $query->fetch();
        $tulos = array(
            'tulosid' => $row['tulosid'],
            'pelaajanimi' => $row['pelaajanimi'],
            'heittomaara' => $row['heittomaara'],
            'paivamaara' => $row['paivamaara']
        );
        return $tulos;
    }

    public static function etsiPelaajanTulokset($pelaajaid) {
        $query = DB::connection()->prepare('SELECT * FROM Tulos WHERE Tulos.pelaajaid = :pelaajaid');
        $query->execute();
        $rows = $query->fetchAll();
        $tulokset = array();
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tulos (rataId, pelaajaId, paivamaara, muistiinpanot) VALUES (:rataid, :pelaajaid, :paivamaara, :muistiinpanot) RETURNING id');
        $query->execute(array('rataid' => $this->rataid, 'pelaajaid' => $this->pelaajaid, 'paivamaara' => $this->paivamaara, 'muistiinpanot' => $this->muistiinpanot));
        $row = $query->fetch();
        $this->id = $row['id'];
        return $this->id;
    }

    public function update($tulosid) {
        $query = DB::connection()->prepare('UPDATE Tulos set rataId = :rataid, pelaajaid = :pelaajaid, paivamaara = :paivamaara, muistiinpanot = :muistiinpanot WHERE id =:tulosid');
        $query->execute(array('rataid' => $this->rataid, 'pelaajaid' => $this->pelaajaid, 'paivamaara' => $this->paivamaara, 'muistiinpanot' => $this->muistiinpanot, 'tulosid' => $tulosid));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Tulos WHERE id=:id');
        $query->execute(array('id' => $id));
    }

    public static function laskeKokonaistulos($tulosid) {
        $query = DB::connection()->prepare('SELECT sum(vt.heitot) AS tulos FROM VaylaTulos vt LEFT JOIN Tulos ON vt.tulosId = Tulos.Id WHERE tulosId = :tulosid');
        $query->execute(array('tulosid' => $tulosid));
        $row = $query->fetch();        
        $tulos = $row['tulos'];
        return $tulos;
    }
    
    public function validate_pvm() {
        if ($this->paivamaara = '') {
            $errors[] = 'Päivämäärä ei saa olla tyhjä!';
        } else if (count($this->paivamaara) != 8) {
            $errors[] = 'Päivämäärän pituus on väärä. Käytä muotoa ddmmyyyy';
        }
    }

    public function validate_muistiinpanot() {
        if (count($this->muistiinpanot) > 300) {
            $errors[] = 'Muistiinpanojen pituus yli 300!';
        }
    }

}
