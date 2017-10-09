<?php

class TermiaiheController extends BaseController{

	public static function store() {
		$params = $_POST;
		$attributes = array(
			'termi_id' => $params['termi_id'],
			'aihe_id' => $params['aihe_id']
		);
		$termiaihe = new Termiaihe($attributes);
		$errors = $termiaihe->errors();

		if(count($errors) == 0){
			$termiaihe->save();
			Redirect::to('/aihe/' . $aihe->id, array('message' => 'Yhteys Termin Ja Aiheen Välillä On Lisätty Järjestelmään!'));
		}else{
			View::make('/aihe/', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function destroy($termi_id, $aihe_id){
		$termiaihe = new Termiaihe(array('termi_id' => $termi_id, 'aihe_id' => $aihe_id));
		$termiaihe->destroy();

		Redirect::to('/aihe', array('message' => 'Yhteys termin ja aiheen välillä on poistettu onnistuneesti!'));
	}
}