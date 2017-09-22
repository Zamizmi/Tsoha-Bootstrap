<?php

class HelloWorldController extends BaseController{

  public static function sandbox(){
      // Testaa koodiasi täällä
    $kurssit = Kurssi::all();
    $aiheet = Aihe::all();
    $termit = Termi::all();
    $kurssi = Kurssi::find(1);

    Kint::dump($kurssi);
    #Kint::dump($aiheet);
    #Kint::dump($termit);
  }
}