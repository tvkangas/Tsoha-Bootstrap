<?php

class pelaaja extends BaseModel {

    public $id, $nimi, $password, $passwordvahvistus, $admin;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_password');
    }

    public static function etsiKirjautunutPelaaja() {
        $pelaajaid = $_SESSION['user'];
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE id=:id');
        $query->execute(array('id' => $pelaajaid));
        $row = $query->fetch();
        $pelaaja = new pelaaja(array(
            'id' => $row['id'],
            'nimi' => $row['nimi'],
            'password' => $row['password']
        ));
        return $pelaaja;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja');
        $query->execute();
        $rows = $query->fetchAll();
        $pelaajat = array();

        foreach ($rows as $row) {
            $pelaajat[] = new pelaaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
            ));
        }
        return $pelaajat;
    }
    
    public static function allEiAdmin() {
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE admin = FALSE');
        $query->execute();
        $rows = $query->fetchAll();
        $pelaajat = array();

        foreach ($rows as $row) {
            $pelaajat[] = new pelaaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password']
            ));
        }
        return $pelaajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $pelaaja = new pelaaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password'],
                'admin' => $row['admin']
            ));
            return $pelaaja;
        }
        return null;
    }

    public static function haePelaajannimi($id) {
        $query = DB::connection()->prepare('SELECT nimi FROM Pelaaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        return $row['nimi'];
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Pelaaja set password = :password WHERE id =:id');
        $query->execute(array('id' => $this->id, 'password' => $this->password));
    }
    
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Pelaaja WHERE id=:id');
        $query->execute(array('id' => $id));
    }

    //Palauttaa 0, jos löytyy jo tällä nimellä pelaaja
    //Palauttaa 1, jos ei löydy pelaajaa
    public static function etsiNimella($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();
        if ($row) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function authenticate($nimi, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE nimi = :nimi AND password = :password LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            return new pelaaja(array('id' => $row['id'], 'nimi' => $row['nimi'], 'password' => $row['password']));
        } else {
            return null;
        }
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä.';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään 3 merkkiä.';
        }
        if (self::etsiNimella($this->nimi) == 0) {
            $errors[] = 'Nimi on jo käytössä. Valitse uusi nimi';
        }
        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if (strlen($this->password) < 5) {
            $errors[] = 'Salasanan pituuden tulee olla vähintään 5 merkkiä.';
        }
        if (strcmp($this->password, $this->passwordvahvistus) !== 0) {
            $errors[] = 'Salasanat eivät täsmää';
        }
        return $errors;
    }

}
