<?php

class BaseController{

  public static function get_user_logged_in(){
    // Katsotaan onko user-avain sessiossa
    if(isset($_SESSION['opiskelija'])){
      $opiskelija_id = $_SESSION['opiskelija'];
      // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
      $opiskelija = Opiskelija::find($opiskelija_id);

      return $opiskelija;
    }

    // Käyttäjä ei ole kirjautunut sisään
    return null;
  }

  public static function check_logged_in(){
    if(!isset($_SESSION['opiskelija'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
  }

}
