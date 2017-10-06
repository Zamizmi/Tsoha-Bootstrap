<?php

class AiheController extends BaseController{
	public static function index(){
		$aiheet = Aihe::all();
		View::make('aihe/index.html', array('aiheet' => $aiheet));
	}

	public static function show($id){
		$aihe = Aihe::find($id);
		$aiheenKurssiaiheidenLkm = Aihe::aiheenKurssiaiheidenLkm($id);
		$kurssit = Aihe::kurssitJoillaAihe($id);
		View::make('aihe/show.html', array('aihe' => $aihe, 'aiheenKurssiaiheidenLkm' => $aiheenKurssiaiheidenLkm, 'kurssit' => $kurssit));
	}

	public static function edit($id){
		$aihe = Aihe::find($id);
		View::make('aihe/edit.html', array('aihe' => $aihe));
	}

	public static function store(){
		$params = $_POST;
		$kurssit = array();
		if (isset($params['kurssit'])) {
			$kurssit = $params['kurssit'];
		}

		$attributes = array(
			'nimi' => $params['nimi'],
			'englanniksi' => $params['englanniksi'],
			'kuvaus' => $params['kuvaus']
		);
		$aihe = new Aihe($attributes);
		$errors = $aihe->errors();

		if(count($errors) == 0){
			$aihe->save();
			foreach ($kurssit as $kurssi) {
				$attributes['kurssit[]'] = $kurssi;
				Aihe::saveKurssiaihe($kurssi, $aihe->id);
			}
			Redirect::to('/aihe/' . $aihe->id, array('message' => 'Aihe On Lisätty Järjestelmään!'));
		}else{
			$kurssit = Kurssi::all();
			View::make('aihe/new.html', array('errors' => $errors, 'attributes' => $attributes, 'kurssit'=> $kurssit));
		}
	}

	public static function update($id) {
		$params = $_POST;
		$attributes = array(
			'id' => $id,
			'nimi' => $params['nimi'],
			'englanniksi' => $params['englanniksi'],
			'kuvaus' => $params['kuvaus']
		);

		$aihe = new Aihe($attributes);
		$errors = $aihe->errors();

		if(count($errors) == 0){
			$aihe->update();
			Redirect::to('/aihe/' . $aihe->id, array('message' => 'Aihe on muokattu onnistuneesti!'));
		}else{
			View::make('aihe/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function destroy($id){
		$aihe = new Aihe(array('id' => $id));
		$aihe->destroy();

		Redirect::to('/aihe', array('message' => 'Aihe on poistettu onnistuneesti!'));
	}

	public static function create() {
		$kurssit = Kurssi::all();
		View::make('aihe/new.html', array('kurssit' => $kurssit));
	}
}