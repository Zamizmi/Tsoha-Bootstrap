<?php

class Kurssiaihe extends BaseModel{

	public $kurssi_id, $aihe_id

	public function __construct($attributes){
		parent::__construct($attributes);
		#$this->validators = array('validate_nimi', 'validate_englanniksi', 'validate_kuvaus');

	}

	public static function findKurssiaiheKurssilla($kurssi_id) {
		$query = DB::connection()->prepare('SELECT * FROM Kurssiaihe WHERE kurssi_id = :kurssi_id');
		$query->execute(array('kurssi_id' => $kurssi_id));
		$rows = $query->fetch();
		$kurssiaiheet = array();

		if($rows) {
			$kurssiaiheet[] = new Kurssiaihe(array(
				'kurssi_id' => $rows['kurssi_id'],
				'aihe_id' => $rows['aihe_id']
			));
			return kurssiaiheet;
		}
		return null;
	}

	public static function findKurssiaiheAiheella($aihe_id) {
		$query = DB::connection()->prepare('SELECT * FROM Kurssiaihe WHERE aihe_id = :aihe_id');
		$query->execute(array('aihe_id' => $aihe_id));
		$rows = $query->fetch();
		$kurssiaiheet = array();

		if($rows) {
			$kurssiaiheet[] = new Kurssiaihe(array(
				'kurssi_id' => $rows['kurssi_id'],
				'aihe_id' => $rows['aihe_id']
			));
			return kurssiaiheet;
		}
		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Kurssiaihe (kurssi_id, aihe_id) VALUES (:kurssi_id, :aihe_id) RETURNING kurssi_id');
		$query -> execute(array('kurssi_id' => $this->kurssi_id, 'aihe_id' => $this->aihe_id));
		$row = $query->fetch();
		$this->kurssi_id = $row['kurssi_id'];
	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Kurssiaihe WHERE kurssi_id =:kurssi_id AND aihe_id = :aihe_id');
		$query -> execute(array('kurssi_id' => $this->kurssi_id, 'aihe_id' => $this->aihe_id));
	}

}