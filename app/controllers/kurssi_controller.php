<?php

class KurssiController extends BaseController{
	public static function index(){
		$kurssit = Kurssi::all();
		View::make('kurssi/index.html', array('kurssit' => $kurssit));
	}

	public static function show($id){
		$kurssit = Kurssi::find($id);
		View::make('kurssi/show.html', array('kurssit' => $kurssit));
	}

	public static function edit($id){
		$kurssit = Kurssi::find($id);
		View::make('kurssi/edit.html', array('kurssit' => $kurssit));
	}

	public static function store() {
		$params = $_POST;
		$kurssi = new Kurssi(array(
			'nimi' => $params['nimi'],
			'kurssitunnus' => $params['kurssitunnus'],
			'kuvaus' => $params['kuvaus']
		));
		$kurssi -> save();
		Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi on lisätty!'));
	}

	public static function create() {
		View::make('kurssi/new.html');
	}
}