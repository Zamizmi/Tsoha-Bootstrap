<?php

class Termi extends BaseModel{
	public $id, $nimi, $englanniksi, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_nimi', 'validate_englanniksi', 'validate_kuvaus');

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

	public function update(){
		$query = DB::connection()->prepare('UPDATE Termi SET nimi = :nimi, englanniksi = :englanniksi, kuvaus = :kuvaus WHERE id = :id');
		$query -> execute(array('id' => $this->id, 'nimi' => $this->nimi, 'englanniksi' => $this->englanniksi, 'kuvaus' => $this->kuvaus));
	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Termi WHERE id =:id');
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