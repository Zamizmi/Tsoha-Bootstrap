<?php

class HelloWorldController extends BaseController{

  public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
    View::make('home.html');
  }

  public static function sandbox(){
      // Testaa koodiasi täällä
    View::make('helloworld.html');

    public static function kurssi_list(){
      View::make('suunnitelmat/kurssi_list.html');
    }

    public static function kurssi_show(){
      View::make('suunnitelmat/kurssi_show.html');
    }

    public static function kurssi_edit(){
      View::make('suunnitelmat/kurssi_edit.html');
    }

    public static function aihe_list(){
      View::make('suunnitelmat/aihe_list.html');
    }

    public static function aihe_show(){
      View::make('suunnitelmat/aihe_show.html');
    }

    public static function aihe_edit(){
      View::make('suunnitelmat/aihe_edit.html');
    }

    public static function termi_list(){
      View::make('suunnitelmat/termi_list.html');
    }

    public static function termi_show(){
      View::make('suunnitelmat/termi_show.html');
    }

    public static function termi_edit(){
      View::make('suunnitelmat/termi_edit.html');
    }

    public static function login(){
      View::make('suunnitelmat/opiskelija/login.html');
    }
  }
}
