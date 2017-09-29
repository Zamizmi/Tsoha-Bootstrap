<?php

class Opiskelija extends BaseModel{
	public $id, $kayttajatunnus, $salasana;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		$opiskelija = array();


		if($row){
			$opiskelija = new Kurssi(array(
				'id' => $row['id'],
				'kayttajatunnus' => $row['kayttajatunnus'],
				'salasana' => $row['salasana']
			));
			return $opiskelija;
		}
		return null;
	}
#EI TESTATTU ETTÄ TOIMII
	public function save() {
		$query = DB::connection() -> prepare('INSERT INTO Opiskelija (kayttajatunnus, salasana) VALUES (:kayttajatunnus, :salasana) RETURNING id');
		$query -> execute(array('kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana));
			$row = $query->fetch();
			$this->id = $row['id'];
		}

		public static function authenticate($kayttajatunnus, $salasana) {
			$query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
			$query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
			$row = $query->fetch();
			if($row){
				$opiskelija = new Opiskelija(array(
					'id' => $row['id'],
					'kayttajatunnus' => $row['kayttajatunnus'],
					'salasana' => $row['salasana']
				));
				return $opiskelija;
			}else{
				return null;
			}
		}
	}