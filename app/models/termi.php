<?php

class Termi extends BaseModel{
	public $id, $nimi, $englanniksi, $kuvaus;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_nimi', 'validate_englanniksi', 'validate_kuvaus');

	}

	public static function aiheetJoillaTermi($termi_id) {
		$query = DB::connection()->prepare('SELECT DISTINCT id FROM Aihe INNER JOIN Termiaihe ON Termiaihe.termi_id = :termi_id AND Aihe.id = Termiaihe.aihe_id');
		$query -> execute(array('termi_id' => $termi_id));
		$rows = $query->fetchAll();
		$aiheet = array();

		foreach($rows as $row){
			$aihe = Aihe::find($row['id']);
			if ($aihe) {
				$aiheet[] = $aihe;
			}
		}
		return $aiheet;
	}

	public static function termitJoillaAihe() {
		
	}

	public static function terminTermiaiheidenLkm($termi_id) {
		$query = DB::connection()->prepare('SELECT COUNT ( DISTINCT id) FROM Aihe INNER JOIN Termiaihe ON Termiaihe.termi_id = :termi_id AND Aihe.id = Termiaihe.aihe_id');
		$query -> execute(array('termi_id' => $termi_id));
		$lukumaara = $query->fetch();

		return $lukumaara[0];
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
		$termi = array();

		if($row){
			$termi = new Termi(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'englanniksi' => $row['englanniksi'],
				'kuvaus' => $row['kuvaus']
			));

			return $termi;
		}
		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Termi (nimi, englanniksi, kuvaus) VALUES (:nimi, :englanniksi, :kuvaus) RETURNING id');
		$query -> execute(array('nimi' => $this->nimi, 'englanniksi' => $this->englanniksi, 'kuvaus' => $this->kuvaus));
		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public static function saveTermiaihe($termi_id, $aihe_id) {
		$termi = Termi::find($termi_id);

		$query = DB::connection()->prepare('INSERT INTO Termiaihe (termi_id, aihe_id) VALUES(:termi_id, :aihe_id)');
		$query->execute(array('termi_id' => $termi->id, 'aihe_id' => $aihe_id));
	}

	public function update(){
		$query = DB::connection()->prepare('UPDATE Termi SET nimi = :nimi, englanniksi = :englanniksi, kuvaus = :kuvaus WHERE id = :id');
		$query -> execute(array('id' => $this->id, 'nimi' => $this->nimi, 'englanniksi' => $this->englanniksi, 'kuvaus' => $this->kuvaus));
	}

	public function destroy() {
		$termiaiheQuery =DB::connection()->prepare('DELETE FROM Termiaihe WHERE termi_id =:id');
		$termiaiheQuery -> execute(array('id' => $this->id));
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