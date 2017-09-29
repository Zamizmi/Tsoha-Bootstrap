<?php

class KurssiController extends BaseController{
	public static function index(){
		$kurssit = Kurssi::all();
		View::make('kurssi/index.html', array('kurssit' => $kurssit));
	}

	public static function show($id){
		$kurssi = Kurssi::find($id);
		View::make('kurssi/show.html', array('kurssi' => $kurssi));
	}

	public static function edit($id){
		$kurssi = Kurssi::find($id);
		View::make('kurssi/edit.html', array('kurssi' => $kurssi));
	}

	public static function store() {
		$params = $_POST;
		$attributes = array(
			'nimi' => $params['nimi'],
			'kurssitunnus' => $params['kurssitunnus'],
			'kuvaus' => $params['kuvaus']
		);
		$kurssi = new Kurssi($attributes);
		$errors = $kurssi->errors();

		if(count($errors) == 0){
			$kurssi->save();
			Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi On Lisätty Järjestelmään!'));
		}else{
			View::make('kurssi/new.html', array('errors' => $errors, 'attributes' => $attributes));
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

		$kurssi = new Kurssi($attributes);
		$errors = $kurssi->errors();

		if(count($errors) == 0){
			$kurssi->update();
			Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi on muokattu onnistuneesti!'));
		}else{
			View::make('kurssi/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function destroy($id){
		$kurssi = new Kurssi(array('id' => $id));
		$kurssi->destroy();

		Redirect::to('/kurssi', array('message' => 'Kurssi on poistettu onnistuneesti!'));
	}

	public static function create() {
		View::make('kurssi/new.html');
	}
}