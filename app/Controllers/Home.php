<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        echo "Hola Mundo";
        return view('welcome_message');
    }
}
