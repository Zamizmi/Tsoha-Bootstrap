<?php

class Aihe extends BaseModel{
	public $id, $nimi, $englanniksi, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_nimi', 'validate_englanniksi', 'validate_kuvaus');
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
				'englanniksi' => $row['englanniksi'],
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
				'englanniksi' => $row['englanniksi'],
				'kuvaus' => $row['kuvaus']
			));
			return $aiheet;
		}
		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Aihe (nimi, englanniksi, kuvaus) VALUES (:nimi, :englanniksi, :kuvaus) RETURNING id');
		$query -> execute(array('nimi' => $this->nimi, 'englanniksi' => $this->englanniksi, 'kuvaus' => $this->kuvaus));
		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public function update(){
		$query = DB::connection()->prepare('UPDATE Aihe SET nimi = :nimi, englanniksi = :englanniksi, kuvaus = :kuvaus WHERE id = :id');
		$this->validators = array('validate_nimi', 'validate_englanniksi', 'validate_kuvaus');
		$query -> execute(array('id' => $this->id, 'nimi' => $this->nimi, 'englanniksi' => $this->englanniksi, 'kuvaus' => $this->kuvaus));
	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Aihe WHERE id =:id');
		$query -> execute(array('id' => $this->id));
	}

	public function validate_nimi() {
		return parent::validate_string_length('Nimi', $this->nimi, 2, 50);
	}

	public function validate_englanniksi() {
		return parent::validate_string_length('Englanniksi', $this->englanniksi, 2, 50);
	}

	public function validate_kuvaus() {
		return parent::validate_string_length('Kuvaus', $this->kuvaus, 2, 500);
	}
}