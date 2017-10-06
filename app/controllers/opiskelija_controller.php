<?php

class OpiskelijaController extends BaseController{
  public static function login(){
    View::make('opiskelija/login.html');
  }

  public static function logout(){
    $_SESSION['opiskelija'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }

  public static function handle_login(){
    $params = $_POST;

    $opiskelija = Opiskelija::authenticate($params['kayttajatunnus'], $params['salasana']);

    if(!$opiskelija){
      View::make('opiskelija/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
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