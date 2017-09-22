<?php

class AiheController extends BaseController{
	public static function index(){
		$aiheet = Aihe::all();
		View::make('aihe/index.html', array('aiheet' => $aiheet));
	}

	public static function show($id){
		$aiheet = Aihe::find($id);
		View::make('aihe/show.html', array('aiheet' => $aiheet));
	}

	public static function edit($id){
		$aiheet = Aihe::find($id);
		View::make('aihe/edit.html', array('aiheet' => $aiheet));
	}

	public static function store() {
		$params = $_POST;
		$aihe = new Aihe(array(
			'nimi' => $params['nimi'],
			'kuvaus' => $params['kuvaus']
		));
		$aihe -> save();
		Redirect::to('/aihe/' . $aihe->id, array('message' => 'Aihe On Lisätty!'));
	}

	public static function create() {
		View::make('aihe/new.html');
	}
}