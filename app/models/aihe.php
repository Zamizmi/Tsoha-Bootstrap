<?php

class Aihe extends BaseModel{
	public $id, $nimi, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Aihe');
		$query->execute();
		$rows = $query->fetchAll();
		$aiheet = array();
		foreach($rows as $row){
			$aiheet[] = new Aihe(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'kuvaus' => $row['kuvaus']
			));
		}

		return $aiheet;
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Aihe WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		$aiheet = array();


		if($row){
			$aiheet[] = new Aihe(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'kuvaus' => $row['kuvaus']
			));
			return $aiheet;
		}
		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Aihe (nimi, kuvaus) VALUES (:nimi, :kuvaus) RETURNING id');
		$query -> execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus));
		$row = $query->fetch();
		$this->id = $row['id'];
	}
}