<?php

class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
  protected $validators;

  public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
    foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
      if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
        $this->{$attribute} = $value;
      }
    }
  }

  public function errors() {
    $errors = array();
    foreach ($this->validators as $validator) {
      $errors = array_merge($errors, $this->{$validator}());
    }
    return array_filter($errors);
  }

  public function validate_string_length($nimi, $string, $pituus, $maxPituus) {
    $string = trim($string);
    $errors = array();
    if ($string == '' || $string == null) {
      $errors[] = $nimi . ' ei saa olla tyhjä';
    }
    if (strlen($string) < $pituus) {
      $errors[] = $nimi . ' tulisi olla vähintään ' . $pituus . ' merkkiä pitkä!';
    }
    if (strlen($string) > $maxPituus) {
      $errors[] = $nimi . ' pitäisi olla lyhyempi kuin ' . $maxPituus;
    }
    return $errors;
  }

}
