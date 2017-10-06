<?php

class KurssiaiheController extends BaseController{

	public static function store() {
		$params = $_POST;
		$attributes = array(
			'kurssi_id' => $params['kurssi_id'],
			'aihe_id' => $params['aihe_id']
		);
		$kurssiaihe = new Kurssiaihe($attributes);
		$errors = $kurssiaihe->errors();

		if(count($errors) == 0){
			$kurssiaihe->save();
			Redirect::to('/aihe/' . $aihe->id, array('message' => 'Yhteys Kurssin Ja Aiheen Välillä On Lisätty Järjestelmään!'));
		}else{
			View::make('/aihe/', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function destroy($kurssi_id, $aihe_id){
		$kurssiaihe = new Kurssiaihe(array('kurssi_id' => $kurssi_id, 'aihe_id' => $aihe_id));
		$kurssiaihe->destroy();

		Redirect::to('/aihe', array('message' => 'Yhteys kursin ja aiheen välillä on poistettu onnistuneesti!'));
	}
}