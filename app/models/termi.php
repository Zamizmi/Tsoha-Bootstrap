<?php

class Termi extends BaseModel{
	public $id, $nimi, $englanniksi, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Termi');
		$query->execute();
		$rows = $query->fetchAll();
		$termit = array();
		foreach($rows as $row){
			$termit[] = new Termi(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'englanniksi' => $row['englanniksi'],
				'kuvaus' => $row['kuvaus']
			));
		}

		return $termit;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Termi WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		$termit = array();

		if($row){
			$termit[] = new Termi(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'englanniksi' => $row['englanniksi'],
				'kuvaus' => $row['kuvaus']
			));

			return $termit;
		}
		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Termi (nimi, englanniksi, kuvaus) VALUES (:nimi, :englanniksi, :kuvaus) RETURNING id');
		$query -> execute(array('nimi' => $this->nimi, 'englanniksi' => $this->englanniksi, 'kuvaus' => $this->kuvaus));
		$row = $query->fetch();
		$this->id = $row['id'];
	}
}