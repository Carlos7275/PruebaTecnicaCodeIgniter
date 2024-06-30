<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function login(): string
    {
        return view('home/login');
    }

    public function registrar()
    {
        return view('home/registro');
    }
}
