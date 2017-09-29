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
		$attributes = array(
			'nimi' => $params['nimi'],
			'englanniksi' => $params['englanniksi'],
			'kuvaus' => $params['kuvaus']
		);
		$termi = new Termi($attributes);
		$errors = $termi->errors();

		if(count($errors) == 0){
			$termi->save();
			Redirect::to('/termi/' . $termi->id, array('message' => 'Termi On Lisätty Järjestelmään!'));
		}else{
			View::make('termi/new.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

		public static function update($id){
		$params = $_POST;
		$attributes = array(
			'id' => $id,
			'nimi' => $params['nimi'],
			'englanniksi' => $params['englanniksi'],
			'kuvaus' => $params['kuvaus']
		);

		$termi = new Termi($attributes);
		$errors = $termi->errors();

		if(count($errors) == 0){
			$termi->update();
			Redirect::to('/termi/' . $termi->id, array('message' => 'Termi on muokattu onnistuneesti!'));
		}else{
			View::make('termi/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function destroy($id){
		$termi = new Termi(array('id' => $id));
		$termi->destroy();

		Redirect::to('/termi', array('message' => 'Termi on poistettu onnistuneesti!'));
	}

	public static function create() {
		View::make('termi/new.html');
	}
}