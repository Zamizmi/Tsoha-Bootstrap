<?php

class HelloWorldController extends BaseController{

  public static function sandbox(){
      // Testaa koodiasi täällä
    $jym = new Kurssi(array(
      'nimi' =>'Jy',
      'kurssitunnus' => 'jymppa',
      'kuvaus' => 'jeejee'
    ));
    $aiheetJoillaKurssiaihe = Aihe::aiheetJoillaKurssiaihe(1);
    $aiheetJoillaTiettyKurssiaihe = Aihe::aiheetJoillaTiettyKurssiaihe(1);
    $kurssitJoillaKurssiaihe = Kurssi::kurssitJoillaKurssiaihe(1);
    $kurssinKurssiaiheidenLkm = Kurssi::kurssinKurssiaiheidenLkm(1);
    Kint::dump($aiheetJoillaKurssiaihe);
    Kint::dump($aiheetJoillaTiettyKurssiaihe);
    Kint::dump($kurssitJoillaKurssiaihe);
    Kint::dump($kurssinKurssiaiheidenLkm);
    Kint::dump(Kurssi::all());
  }
}