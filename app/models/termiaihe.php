<?php

class Termiaihe extends BaseModel{

	public $termi_id, $aihe_id

	public function __construct($attributes){
		parent::__construct($attributes);
		#$this->validators = array('validate_nimi', 'validate_englanniksi', 'validate_kuvaus');

	}

	public static function findTermiaiheTermilla($termi_id) {
		$query = DB::connection()->prepare('SELECT * FROM Termiaihe WHERE termi_id = :termi_id');
		$query->execute(array('termi_id' => $termi_id));
		$rows = $query->fetch();
		$termiaiheet = array();

		if($rows) {
			$termiaiheet[] = new Termiaihe(array(
				'termi_id' => $rows['termi_id'],
				'aihe_id' => $rows['aihe_id']
			));
			return termiaiheet;
		}
		return null;
	}

	public static function findTermiaiheAiheella($aihe_id) {
		$query = DB::connection()->prepare('SELECT * FROM Termiaihe WHERE aihe_id = :aihe_id');
		$query->execute(array('aihe_id' => $aihe_id));
		$rows = $query->fetch();
		$termiaiheet = array();

		if($rows) {
			$termiaiheet[] = new Termiaihe(array(
				'termi_id' => $rows['termi_id'],
				'aihe_id' => $rows['aihe_id']
			));
			return termiaiheet;
		}
		return null;
	}

	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Termiaihe (termi_id, aihe_id) VALUES (:termi_id, :aihe_id) RETURNING termi_id');
		$query -> execute(array('termi_id' => $this->termi_id, 'aihe_id' => $this->aihe_id));
		$row = $query->fetch();
		$this->termi_id = $row['termi_id'];
	}

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Termiaihe WHERE termi_id =:termi_id AND aihe_id = :aihe_id');
		$query -> execute(array('termi_id' => $this->termi_id, 'aihe_id' => $this->aihe_id));
	}

}