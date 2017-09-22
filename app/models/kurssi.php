<?php

class Kurssi extends BaseModel{
	public $id, $nimi, $kurssitunnus, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Kurssi');
		$query->execute();
		$rows = $query->fetchAll();
		$kurssit = array();
		foreach($rows as $row){
			$kurssit[] = new Kurssi(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'kurssitunnus' => $row['kurssitunnus'],
				'kuvaus' => $row['kuvaus']
			));
		}

		return $kurssit;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		$kurssit = array();


		if($row){
			$kurssit[] = new Kurssi(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'kurssitunnus' => $row['kurssitunnus'],
				'kuvaus' => $row['kuvaus']
			));

			return $kurssit;
		}

		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Kurssi (nimi, kurssitunnus, kuvaus) VALUES (:nimi, :kurssitunnus, :kuvaus) RETURNING id');
		$query -> execute(array('nimi' => $this->nimi, 'kurssitunnus' => $this->kurssitunnus, 'kuvaus' => $this->kuvaus));
		$row = $query->fetch();
		$this->id = $row['id'];
	}
}