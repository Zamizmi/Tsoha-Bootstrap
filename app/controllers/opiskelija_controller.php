<?php

class OpiskelijaController extends BaseController{
  public static function login(){
    View::make('opiskelija/login.html');
  }

  public static function create() {
    View::make('opiskelija/signup.html');
  }

  public static function store() {
    $params = $_POST;

    $attributes = array(
      'kayttajatunnus' => $params['kayttajatunnus'],
      'salasana' => $params['salasana']
    );

    $opiskelija = new Opiskelija($attributes);
    $errors = $opiskelija->errors();

    if(count($errors) == 0){
      $opiskelija->save();

      Redirect::to('/kurssi', array('message' => 'Käyttäjätunnus On Luotu Onnistuneesti!'));
    }else{
      View::make('opiskelija/signup.html', array('errors' => $errors));
    }
  }

  public static function logout(){
    $_SESSION['opiskelija'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }

  public static function handle_login(){
    $params = $_POST;

    $opiskelija = Opiskelija::authenticate($params['kayttajatunnus'], $params['salasana']);

    if(!$opiskelija){
      View::make('opiskelija/login.html', array('errors' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
    }else{
      $_SESSION['opiskelija'] = $opiskelija->id;
      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $opiskelija->kayttajatunnus . '!'));
    }
  }

  public static function show() {
    self::check_logged_in();
    $opiskelija = parent::get_user_logged_in();
    View::make('opiskelija/show.html', array('message' => 'Täällä ei ole vielä mitään!', 'opiskelija' => $opiskelija));
  }
}