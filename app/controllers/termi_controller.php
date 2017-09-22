<?php

class TermiController extends BaseController{
	public static function index(){
		$termit = Termi::all();
		View::make('termi/index.html', array('termit' => $termit));
	}

	public static function show($id){
		$termit = Termi::find($id);
		View::make('termi/show.html', array('termit' => $termit));
	}

	public static function edit($id){
		$termit = Termi::find($id);
		View::make('termi/edit.html', array('termit' => $termit));
	}

	public static function store() {
		$params = $_POST;
		$termi = new Termi(array(
			'nimi' => $params['nimi'],
			'englanniksi' => $params['englanniksi'],
			'kuvaus' => $params['kuvaus']
		));
		$termi -> save();
		Redirect::to('/termi/' . $termi->id, array('message' => 'Termi On Lisätty!'));
	}

	public static function create() {
		View::make('termi/new.html');
	}
}