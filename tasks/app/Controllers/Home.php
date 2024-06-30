<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function login()
    {
        return view('home/login');
    }

    public function inicio()
    {
        $session = session("usuario");
        $data["usuario"] = $session;
        return view("home/inicio", $data);
    }

    public function registrar()
    {
        return view('home/registro');
    }
}
