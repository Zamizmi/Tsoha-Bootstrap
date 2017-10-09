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

	public static function kurssitJoillaAihe($aihe_id) {
		$query = DB::connection()->prepare('SELECT DISTINCT id FROM Kurssi INNER JOIN Kurssiaihe ON Kurssiaihe.aihe_id = :aihe_id AND Kurssiaihe.kurssi_id = Kurssi.id');
		$query -> execute(array('aihe_id' => $aihe_id));
		$rows = $query->fetchAll();
		$kurssit = array();

		foreach($rows as $row){
			$kurssi = Kurssi::find($row['id']);
			if ($kurssi) {
				$kurssit[] = $kurssi;
			}
		}
		return $kurssit;
	}

	public static function aiheenKurssiaiheidenLkm($aihe_id) {
		$query = DB::connection()->prepare('SELECT COUNT ( DISTINCT id) FROM Kurssi INNER JOIN Kurssiaihe ON Kurssiaihe.aihe_id = :aihe_id AND Kurssiaihe.kurssi_id = Kurssi.id');
		$query -> execute(array('aihe_id' => $aihe_id));
		$lukumaara = $query->fetch();

		return $lukumaara[0];
	}


	public static function aiheetJoillaTiettyKurssiaihe($kurssi_id) {
		$query = DB::connection()->prepare('SELECT DISTINCT id FROM Aihe INNER JOIN Kurssiaihe ON Kurssiaihe.kurssi_id = :kurssi_id ');
		$query -> execute(array('kurssi_id' => $kurssi_id));
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

	public static function saveKurssiaihe($kurssi_id, $aihe_id) {
		$aihe_id = Aihe::find($aihe_id);

		$query = DB::connection()->prepare('INSERT INTO Kurssiaihe (kurssi_id, aihe_id) VALUES(:kurssi_id, :aihe_id)');
		$query->execute(array('kurssi_id' => $kurssi_id, 'aihe_id' => $aihe_id->id));
	}

	public static function termitJoillaAihe($aihe_id) {
		$query = DB::connection()->prepare('SELECT DISTINCT id FROM Termi INNER JOIN Termiaihe ON Termiaihe.aihe_id = :aihe_id AND Termiaihe.termi_id = Termi.id');
		$query -> execute(array('aihe_id' => $aihe_id));
		$rows = $query->fetchAll();
		$termit = array();

		foreach($rows as $row){
			$termi = Termi::find($row['id']);
			if ($termi) {
				$termit[] = $termi;
			}
		}
		return $termit;
	}

	public static function aiheenTermiaiheidenLkm($aihe_id) {
		$query = DB::connection()->prepare('SELECT COUNT ( DISTINCT id) FROM Termi INNER JOIN Termiaihe ON Termiaihe.aihe_id = :aihe_id AND Termiaihe.termi_id = Termi.id');
		$query -> execute(array('aihe_id' => $aihe_id));
		$lukumaara = $query->fetch();

		return $lukumaara[0];
	}


	public static function aiheetJoillaTiettyTermiaihe($termi_id) {
		$query = DB::connection()->prepare('SELECT DISTINCT id FROM Aihe INNER JOIN Termiaihe ON Termiaihe.termi_id = :termi_id ');
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

	public static function saveTermiaihe($termi_id, $aihe_id) {
		$aihe_id = Aihe::find($aihe_id);

		$query = DB::connection()->prepare('INSERT INTO Termiaihe (termi_id, aihe_id) VALUES(:termi_id, :aihe_id)');
		$query->execute(array('termi_id' => $termi_id, 'aihe_id' => $aihe_id->id));
	}

	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Aihe WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		$aihe = array();

		if($row){
			$aihe = new Aihe(array(
				'id' => $row['id'],
				'nimi' => $row['nimi'],
				'englanniksi' => $row['englanniksi'],
				'kuvaus' => $row['kuvaus']
			));
			return $aihe;
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
		$kurssiaiheQuery =DB::connection()->prepare('DELETE FROM Kurssiaihe WHERE aihe_id =:id');
		$kurssiaiheQuery -> execute(array('id' => $this->id));
		$termiaiheQuery =DB::connection()->prepare('DELETE FROM Termiaihe WHERE aihe_id =:id');
		$termiaiheQuery -> execute(array('id' => $this->id));
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