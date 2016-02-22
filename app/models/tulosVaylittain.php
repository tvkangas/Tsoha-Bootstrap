<?php

class tulosVaylittain extends BaseModel {

    public $id, $tulos_id, $vayla1, $vayla2, $vayla3, $vayla4, $vayla5, $vayla6,
            $vayla7, $vayla8, $vayla9, $vayla10, $vayla11,
            $vayla12, $vayla13, $vayla14, $vayla15, $vayla16, $vayla17, $vayla18;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM TuloksetVaylittain');
        $query->execute();
        $rows = $query->fetchAll();
        $tuloksetVaylittain = array();

        foreach ($rows as $row) {
            $tuloksetVaylittain[] = new tulosVaylittain(array(
                'id' => $row['id'],
                'tulos_id' => $row['tulos_id'],
                'vayla1' => $row['vayla1'],
                'vayla2' => $row['vayla2'],
                'vayla3' => $row['vayla3'],
                'vayla4' => $row['vayla4'],
                'vayla5' => $row['vayla5'],
                'vayla6' => $row['vayla6'],
                'vayla7' => $row['vayla7'],
                'vayla8' => $row['vayla8'],
                'vayla9' => $row['vayla9'],
                'vayla10' => $row['vayla10'],
                'vayla11' => $row['vayla11'],
                'vayla12' => $row['vayla12'],
                'vayla13' => $row['vayla13'],
                'vayla14' => $row['vayla14'],
                'vayla15' => $row['vayla15'],
                'vayla16' => $row['vayla16'],
                'vayla17' => $row['vayla17'],
                'vayla18' => $row['vayla18']
            ));
        }
        return $tuloksetVaylittain;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM TuloksetVaylittain WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $tulos = new tulosVaylittain(array(
                'id' => $row['id'],
                'tulos_id' => $row['tulos_id'],
                'vayla1' => $row['vayla1'],
                'vayla2' => $row['vayla2'],
                'vayla3' => $row['vayla3'],
                'vayla4' => $row['vayla4'],
                'vayla5' => $row['vayla5'],
                'vayla6' => $row['vayla6'],
                'vayla7' => $row['vayla7'],
                'vayla8' => $row['vayla8'],
                'vayla9' => $row['vayla9'],
                'vayla10' => $row['vayla10'],
                'vayla11' => $row['vayla11'],
                'vayla12' => $row['vayla12'],
                'vayla13' => $row['vayla13'],
                'vayla14' => $row['vayla14'],
                'vayla15' => $row['vayla15'],
                'vayla16' => $row['vayla16'],
                'vayla17' => $row['vayla17'],
                'vayla18' => $row['vayla18']
            ));
            return $tulosVaylittain;
        }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO TuloksetVaylittain (tulos_id, vayla1, vayla2, vayla3, vayla4, vayla5, vayla6, vayla7, vayla8, vayla9, vayla10, vayla11, vayla12, vayla13, vayla14, vayla15, vayla16, vayla17, vayla18) '
                . 'VALUES (:tulos_id, :vayla1, :vayla2, :vayla3, :vayla4, :vayla5, :vayla6, :vayla7, :vayla8, :vayla9, :vayla10, :vayla11, :vayla12, :vayla13, :vayla14, :vayla15, :vayla16, :vayla17, :vayla');
        $query->execute(array('tulos_id'=>$this->tulos_id, 'vayla1'=>$this->vayla1, 'vayla2'=>$this->vayla2, 'vayla3'=>$this->vayla3, 'vayla4'=>$this->vayla4, 'vayla5'=>$this->vayla5, 'vayla6'=>$this->vayla6, 'vayla7'=>$this->vayla7, 'vayla8'=>$this->vayla8, 'vayla9'=>$this->vayla9, 'vayla10'=>$this->vayla10, 'vayla11'=>$this->vayla11, 'vayla12'=>$this->vayla12, 'vayla13'=>$this->vayla13, 'vayla14'=>$this->vayla14, 'vayla15'=>$this->vayla15, 'vayla16'=>$this->vayla16, 'vayla17'=>$this->vayla17, 'vayla18'=>$this->vayla18));
        $row = $query->fetch();
        $this->id = $row['id'];
        return $this->id;
    }

    public function update($id){
        $query = DB::connection()->prepare('UPDATE TuloksetVaylittain set tulos_id = :tulos_id vayla1 = :vayla1, vayla2 = :vayla2, vayla3 = :vayla3, vayla4 = :vayla4, vayla5 = :vayla5, vayla6 = :vayla6, vayla7 = :vayla7, vayla8 = :vayla8, vayla9 = :vayla9, vayla10 = :vayla10, vayla11 = :vayla11, vayla12 = :vayla12, vayla13 = :vayla13, vayla14 = :vayla14, vayla15 = :vayla15, vayla16 = :vayla16, vayla17 = :vayla17, vayla18 = :vayla18 WHERE id =:id');
$query->execute(array('tulos_id'=>$this->tulos_id, 'vayla1'=>$this->vayla1, 'vayla2'=>$this->vayla2, 'vayla3'=>$this->vayla3, 'vayla4'=>$this->vayla4, 'vayla5'=>$this->vayla5, 'vayla6'=>$this->vayla6, 'vayla7'=>$this->vayla7, 'vayla8'=>$this->vayla8, 'vayla9'=>$this->vayla9, 'vayla10'=>$this->vayla10, 'vayla11'=>$this->vayla11, 'vayla12'=>$this->vayla12, 'vayla13'=>$this->vayla13, 'vayla14'=>$this->vayla14, 'vayla15'=>$this->vayla15, 'vayla16'=>$this->vayla16, 'vayla17'=>$this->vayla17, 'vayla18'=>$this->vayla18, 'id'=>$this->id));
    }
    
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM TuloksetVaylittain WHERE id=:id');
        $query->execute(array('id'=>$id));
    }

}
