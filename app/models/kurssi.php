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

	public static function aiheetJoillaKurssi($kurssi_id) {
		$query = DB::connection()->prepare('SELECT DISTINCT id FROM Aihe INNER JOIN Kurssiaihe ON Kurssiaihe.kurssi_id = :kurssi_id AND Aihe.id = Kurssiaihe.aihe_id');
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

	public static function kurssinKurssiaiheidenLkm($kurssi_id) {
		$query = DB::connection()->prepare('SELECT COUNT ( DISTINCT id) FROM Aihe INNER JOIN Kurssiaihe ON Kurssiaihe.kurssi_id = :kurssi_id AND Aihe.id = Kurssiaihe.aihe_id');
		$query -> execute(array('kurssi_id' => $kurssi_id));
		$lukumaara = $query->fetch();

		return $lukumaara[0];
	}

	public static function saveKurssiaihe($kurssi_id, $aihe_id) {
		$kurssi = Kurssi::find($kurssi_id);

		$query = DB::connection()->prepare('INSERT INTO Kurssiaihe (kurssi_id, aihe_id) VALUES(:kurssi_id, :aihe_id)');
		$query->execute(array('kurssi_id' => $kurssi->id, 'aihe_id' => $aihe_id));
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
		$kurssiaiheQuery =DB::connection()->prepare('DELETE FROM Kurssiaihe WHERE kurssi_id =:id');
		$kurssiaiheQuery -> execute(array('id' => $this->id));
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