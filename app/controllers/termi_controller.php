<?php

class TermiController extends BaseController{
	public static function index(){
		$termit = Termi::all();
		View::make('termi/index.html', array('termit' => $termit));
	}

	public static function show($id){
		$termi = Termi::find($id);
		$terminTermiaiheidenLkm = Termi::terminTermiaiheidenLkm($id);
		$aiheet = Termi::aiheetJoillaTermi($id);

		View::make('termi/show.html', array('termi' => $termi, 'terminTermiaiheidenLkm' => $terminTermiaiheidenLkm, 'aiheet' => $aiheet));
	}

	public static function edit($id){
		$termi = Termi::find($id);
		$aiheet = Aihe::all();
		View::make('termi/edit.html', array('termi' => $termi, 'aiheet' => $aiheet));
	}

	public static function store() {
		$aiheetLista = Aihe::all();
		$params = $_POST;
		$aiheet = array();

		if (isset($params['aiheet'])) {
			$aiheet = $params['aiheet'];
		}

		$attributes = array(
			'nimi' => $params['nimi'],
			'englanniksi' => $params['englanniksi'],
			'kuvaus' => $params['kuvaus']
		);
		$termi = new Termi($attributes);
		$errors = $termi->errors();

		if(count($errors) == 0){
			$termi->save();
			foreach ($aiheet as $aihe) {
				$attributes['aiheet[]'] = $aihe;
				Termi::saveTermiaihe($termi->id, $aihe);
			}
			Redirect::to('/termi/' . $termi->id, array('message' => 'Termi On Lisätty Järjestelmään!'));
		}else{
			$aiheet = Aihe::all();
			View::make('termi/new.html', array('errors' => $errors, 'attributes' => $attributes, 'aiheet' =>$aiheetLista));
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
		$aiheet = array();
		if (isset($params['aiheet'])) {
			$aiheet = $params['aiheet'];
		}

		$termi = new Termi($attributes);
		$errors = $termi->errors();

		if(count($errors) == 0){
			$termi->update();
			foreach ($aiheet as $aihe) {
				$attributes['aiheet[]'] = $aihe;
				Termi::saveTermiaihe($termi->id, $aihe);
			}
			Redirect::to('/termi/' . $termi->id, array('message' => 'Termi On Muokattu Onnistuneesti!'));
		}else{
			$aiheet = Aihe::all();
			View::make('termi/'.$termi->id.'edit.html', array('errors' => $errors, 'attributes' => $attributes, 'aiheet' => $aiheet));
		}
	}

	public static function destroy($id){
		$termi = new Termi(array('id' => $id));
		$termi->destroy();

		Redirect::to('/termi', array('message' => 'Termi on poistettu onnistuneesti!'));
	}

	public static function create() {
		$aiheet = Aihe::all();
		View::make('termi/new.html', array('aiheet' => $aiheet));
	}
}