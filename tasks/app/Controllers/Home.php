<?php

namespace App\Controllers;

class Home extends BaseController
{
  
    public function inicio()
    {
        $session = session("usuario");
        $data["usuario"] = $session;
        return view("home/inicio", $data);
    }

   
}
