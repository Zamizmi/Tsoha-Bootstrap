<?php

class KurssiController extends BaseController{
	public static function index(){
		$kurssit = Kurssi::all();
		View::make('kurssi/index.html', array('kurssit' => $kurssit));
	}

	public static function show($id){
		$kurssi = Kurssi::find($id);
		$kurssinKurssiaiheidenLkm = Kurssi::kurssinKurssiaiheidenLkm($id);
		$aiheet = Kurssi::aiheetJoillaKurssi($id);
		View::make('kurssi/show.html', array('kurssi' => $kurssi, 'kurssinKurssiaiheidenLkm' => $kurssinKurssiaiheidenLkm, 'aiheet' => $aiheet));
	}

	public static function edit($id){
		$kurssi = Kurssi::find($id);
		$aiheet = Aihe::all();

		View::make('kurssi/edit.html', array('attributes' => $kurssi, 'aiheet' => $aiheet));
	}

	public static function store() {
		$params = $_POST;
		$aiheet = array();
		if (isset($params['aiheet'])) {
			$aiheet = $params['aiheet'];
		}

		$attributes = array(
			'nimi' => $params['nimi'],
			'kurssitunnus' => $params['kurssitunnus'],
			'kuvaus' => $params['kuvaus']
		);
		$kurssi = new Kurssi($attributes);
		$errors = $kurssi->errors();

		if(count($errors) == 0){
			$kurssi->save();
			foreach ($aiheet as $aihe) {
				$attributes['aiheet[]'] = $aihe;
				Kurssi::saveKurssiaihe($kurssi->id, $aihe);
			}
			Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi On Lisätty Järjestelmään!'));
		}else{
			$aiheet = Aihe::all();
			View::make('kurssi/new.html', array('errors' => $errors, 'attributes' => $attributes, 'aiheet' => $aiheet));
		}
	}

	public static function update($id){
		$params = $_POST;
		$attributes = array(
			'id' => $id,
			'nimi' => $params['nimi'],
			'kurssitunnus' => $params['kurssitunnus'],
			'kuvaus' => $params['kuvaus']
		);
		$aiheet = array();
		if (isset($params['aiheet'])) {
			$aiheet = $params['aiheet'];
		}

		$kurssi = new Kurssi($attributes);
		$errors = $kurssi->errors();

		if(count($errors) == 0){
			$kurssi->update();
			foreach ($aiheet as $aihe) {
				$attributes['aiheet[]'] = $aihe;
				Kurssi::saveKurssiaihe($kurssi->id, $aihe);
			}
			Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi On Muokattu Onnistuneesti!'));
		}else{
			$aiheet = Aihe::all();
			View::make('kurssi/'.$kurssi->id.'edit.html', array('errors' => $errors, 'attributes' => $attributes, 'aiheet' => $aiheet));
		}
	}

	public static function destroy($id){
		
		$kurssi = new Kurssi(array('id' => $id));
		$kurssi->destroy();

		Redirect::to('/kurssi', array('message' => 'Kurssi on poistettu onnistuneesti!'));
	}

	public static function create() {
		$aiheet = Aihe::all();
		View::make('kurssi/new.html', array('aiheet' => $aiheet));
	}
}