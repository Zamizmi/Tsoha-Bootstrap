<?php

class HelloWorldController extends BaseController{

  public static function sandbox(){
      // Testaa koodiasi täällä
    $jym = new Kurssi(array(
      'nimi' =>'Jy',
      'kurssitunnus' => 'jymppa',
      'kuvaus' => 'jeejee'
    ));
    $kurssi = Kurssi::find(1);
    $messages = $jym->errors();
    Kint::dump($kurssi);
    #Kint::dump($aiheet);
    #Kint::dump($termit);
  }
}