<?php

class tulos extends BaseModel {

    public $id, $rataId, $pelaajaId, $paivamaara, $muistiinpanot, $par, $kokonaistulos, $paras;

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
    
    public static function etsiRadalla($rataId) {
        $query = DB::connection()->prepare('SELECT * FROM Tulos LEFT JOIN Rata ON Tulos.rataId = Rata.id WHERE Tulos.rataId = :rataId');
        $query->execute(array('rataId' => $rataId));
        $rows = $query->fetchAll();
        $tulokset = array();
        $paras = 0;
        $parasPelaajaId = '';

        foreach ($rows as $row) {
            $apu = tulos::laskeKokonaistulos($row['id']);
            $kokonaistulos = $apu['heitot'];
            $par = $apu['par'];
            $pelaajaId = $apu['pelaajaId'];
            $rataNimi = $row['nimi'];
            if ($paras > $kokonaistulos) {
                $parasPelaajaId = $pelaajaId;
                $paras = $kokonaistulos;
            }
            
            $tulokset[] = new tulos(array(
                'id' => $row['id'],
                'rataId' => $row['rataid'],
                'pelaajaId' => $row['pelaajaid'],
                'paivamaara' => $row['paivamaara'],
                'muistiinpanot' => $row['muistiinpanot'],
                'kokonaistulos' => $kokonaistulos,
                'par' => $par,
                'paras' => $paras,
                'rataNimi' => $rataNimi,
                'parasPelaaja' => $pelaajaId
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
    
    public static function laskeKokonaistulos($id){
        $query = DB::connection()->prepare('SELECT vt.tulosId, vt.vaylaId, vt.heitot, Tulos.pelaajaId AS pelaajaid FROM VaylaTulos vt LEFT JOIN Tulos ON vt.tulosId = Tulos.Id WHERE tulosId = :id');
        $query->execute(array('id'=>$id));
        $rows = $query->fetchAll();
        
        $heitot = 0;
        $par = 0;
        $pelaajaId = 0;
        foreach($rows as $row) {
            $pelaajaId = $row['pelaajaid'];
            $heitot += $row['heitot'];
            $query_tmp = DB::connection()->prepare('SELECT par FROM Vayla WHERE id = :id LIMIT 1');
            $query_tmp->execute(array('id' => $id));
            $vayla = $query_tmp->fetch();
            if ($row) {
                $par += $vayla['par'];
            } else {
                $par += 3; 
            }
        }
        $palautus = array('par'=>$par, 'heitot'=>$heitot, 'pelaajaId'=>$pelaajaId);
        return $palautus;
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
