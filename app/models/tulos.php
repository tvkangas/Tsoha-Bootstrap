<?php

class tulos extends BaseModel {

    public $id, $rataid, $pelaajaid, $paivamaara, $muistiinpanot, $par, $heittomaara, $paras, $pelaajanimi ,$paraspelaaja;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_pvm', 'validate_muistiinpanot');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tulos');
        $query->execute();
        $rows = $query->fetchAll();
        $tulokset = array();

        foreach ($rows as $row) {
            $apu = tulos::laskeKokonaistulos($row['id']);
            $kokonaistulos = $apu['heitot'];
            $par = $apu['par'];

            $tulokset[] = new tulos(array(
                'id' => $row['id'],
                'rataId' => $row['rataId'],
                'pelaajaId' => $row['pelaajaId'],
                'paivamaara' => $row['paivamaara'],
                'muistiinpanot' => $row['muistiinpanot'],
                'kokonaistulos' => $kokonaistulos,
                'par' => $par
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
                'rataId' => $row['rataId'],
                'pelaajaId' => $row['pelaajaId'],
                'paivamaara' => $row['paivamaara'],
                'muistiinpanot' => $row['muistiinpanot']
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

    public static function etsiRadanParasPelaajaBLOO($rataId) {
        $query = DB::connection()->prepare('SELECT Tulos.id AS tulosid,
            Tulos.rataid AS rataid, Tulos.pelaajaid AS pelaajaid,
            Tulos.paivamaara AS paivamaara, Tulos.muistiinpanot AS muistiinpanot,
            Rata.nimi AS ratanimi, Pelaaja.nimi AS pelaajanimi FROM Tulos 
            LEFT JOIN Rata ON Tulos.rataId = Rata.id 
            LEFT JOIN Pelaaja ON Tulos.PelaajaId = Pelaaja.id 
            WHERE Tulos.rataId = :rataId');
        $query->execute(array('rataId' => $rataId));
        $rows = $query->fetchAll();
        $tulokset = array();
        $paras = -1;
        $parasPelaajaId = '';
        $paraspelaaja = 'null';

        foreach ($rows as $row) {
            $apu = tulos::laskeKokonaistulos($row['tulosid']);
            $heitot = $apu['heitot'];
            $pelaajaId = $apu['pelaajaId'];
            $pelaajanimi = $row['pelaajanimi'];
            //$rataNimi = $row['nimi'];
            //$paras = -5;
            if ($paras > $heitot || $paras < 0) {
                $parasPelaajaId = $pelaajaId;
                $paras = $heitot;
                $paraspelaaja = $pelaajanimi;
            }

            $tulokset[] = new tulos(array(
                //'id' => $row['id'],
                'rataId' => $row['rataid'],
                'pelaajanimi' => $row['pelaajanimi'],
                'paivamaara' => $row['paivamaara'],
                'muistiinpanot' => $row['muistiinpanot'],
                'heitot' => $heitot,
                'paras' => $paras,
                //'rataNimi' => $rataNimi,
                'paraspelaajaid' => $pelaajaId,
                'paraspelaaja' => $paraspelaaja
            ));
        }
        return $tulokset;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tulos (rata_id, pelaaja_id, paivamaara, muistiinpanot) VALUES (:rata_id, :pelaaja_id, :paivamaara, :muistiinpanot) RETURNING id');
        $query->execute(array('rata_id' => $this->rata_id, 'pelaaja_id' => $this->pelaaja_id, 'paivamaara' => $this->paivamaara, 'muistiinpanot' => $this->muistiinpanot));
        $row = $query->fetch();
        $this->id = $row['id'];
        return $this->id;
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Tulos set rata_id = :rata_id, pelaaja_id = :pelaaja_id, paivamaara = :paivamaara, muistiinpanot = :muistiinpanot WHERE id =:id');
        $query->execute(array('nimi' => $this->nimi, 'sijainti' => $this->sijainti, 'luokitus' => $this->luokitus, 'id' => $id));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Tulos WHERE id=:id');
        $query->execute(array('id' => $id));
    }

    public static function laskeKokonaistulos($tulosid) {
        $query = DB::connection()->prepare('SELECT sum(vt.heitot) AS tulos FROM VaylaTulos vt LEFT JOIN Tulos ON vt.tulosId = Tulos.Id WHERE tulosId = :tulosid');
        $query->execute(array('tulosid' => $tulosid));
        $row = $query->fetch();
        $tulos = $row['tulosid'];
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
