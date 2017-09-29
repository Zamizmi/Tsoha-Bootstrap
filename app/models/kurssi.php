<?php

class Kurssi extends BaseModel{
	public $id, $nimi, $kurssitunnus, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_nimi','validate_kurssitunnus', 'validate_kuvaus');
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
		$kurssi = array();


		if($row){
			$kurssi = new Kurssi(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'kurssitunnus' => $row['kurssitunnus'],
				'kuvaus' => $row['kuvaus']
			));
			return $kurssi;
		}
		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Kurssi (nimi, kurssitunnus, kuvaus) VALUES (:nimi, :kurssitunnus, :kuvaus) RETURNING id');
		$query -> execute(array('nimi' => $this->nimi, 'kurssitunnus' => $this->kurssitunnus, 'kuvaus' => $this->kuvaus));
		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public function update(){
		$query = DB::connection()->prepare('UPDATE Kurssi SET nimi = :nimi, kurssitunnus = :kurssitunnus, kuvaus = :kuvaus WHERE id = :id');
		$query -> execute(array('id' => $this->id, 'nimi' => $this->nimi, 'kurssitunnus' => $this->kurssitunnus, 'kuvaus' => $this->kuvaus));
	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Kurssi WHERE id =:id');
		$query -> execute(array('id' => $this->id));
	}

	public function validate_nimi() {
		return parent::validate_string_length('Nimi', $this->nimi, 3, 50);
	}

	public function validate_kurssitunnus() {
		return parent::validate_string_length('Kurssitunnus', $this->kurssitunnus, 3, 50);
	}

	public function validate_kuvaus() {
		return parent::validate_string_length('Kuvaus', $this->kuvaus, 3, 500);
	}


}