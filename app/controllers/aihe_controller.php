<?php

class AiheController extends BaseController{
	public static function index(){
		$aiheet = Aihe::all();
		View::make('aihe/index.html', array('aiheet' => $aiheet));
	}

	public static function show($id){
		$aihe = Aihe::find($id);
		$aiheenKurssiaiheidenLkm = Aihe::aiheenKurssiaiheidenLkm($id);
		$aiheenTermiaiheidenLkm = Aihe::aiheenTermiaiheidenLkm($id);

		$kurssit = Aihe::kurssitJoillaAihe($id);
		$termit = Aihe::termitJoillaAihe($id);
		View::make('aihe/show.html', array('aihe' => $aihe, 'aiheenKurssiaiheidenLkm' => $aiheenKurssiaiheidenLkm, 'kurssit' => $kurssit, 'termit' => $termit, 'aiheenTermiaiheidenLkm' => $aiheenTermiaiheidenLkm));
	}

	public static function edit($id){
		$aihe = Aihe::find($id);
		$kurssit = Kurssi::all();
		$termit = Termi::all();
		View::make('aihe/edit.html', array('aihe' => $aihe, 'kurssit' =>$kurssit, 'termit' => $termit));
	}

	public static function store(){
		$params = $_POST;
		$kurssit = array();
		$termit = array();
		if (isset($params['kurssit'])) {
			$kurssit = $params['kurssit'];
		}

		if (isset($params['termit'])) {
			$termit = $params['termit'];
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
			foreach ($termit as $termi) {
				$attributes['termit[]'] = $termi;
				Aihe::saveTermiaihe($termi, $aihe->id);
			}
			Redirect::to('/aihe/' . $aihe->id, array('message' => 'Aihe On Lisätty Järjestelmään!'));
		}else{
			$termit = Termi::all();
			$kurssit = Kurssi::all();
			View::make('aihe/new.html', array('errors' => $errors, 'attributes' => $attributes, 'kurssit'=> $kurssit, 'termit' => $termit));
		}
	}

	public static function update($id) {
		$params = $_POST;
		$kurssit = array();
		$termit = array();

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
			foreach ($kurssit as $kurssi) {
				$attributes['kurssit[]'] = $kurssi;
				Aihe::saveKurssiaihe($kurssi, $aihe->id);
			}
			foreach ($termit as $termi) {
				$attributes['termit[]'] = $termi;
				Aihe::saveTermiaihe($termi, $aihe->id);
			}
			Redirect::to('/aihe/' . $aihe->id, array('message' => 'Aihe On Muokattu Onnistuneesti!'));
		}else{
			$termit = Termi::all();
			$kurssit = Kurssi::all();
			View::make('aihe/new.html', array('errors' => $errors, 'attributes' => $attributes, 'kurssit'=> $kurssit, 'termit' => $termit));
		}
	}

	public static function destroy($id){
		$aihe = new Aihe(array('id' => $id));
		$aihe->destroy();

		Redirect::to('/aihe', array('message' => 'Aihe on poistettu onnistuneesti!'));
	}

	public static function create() {
		$kurssit = Kurssi::all();
		$termit = Termi::all();
		View::make('aihe/new.html', array('kurssit' => $kurssit, 'termit' => $termit));
	}
}