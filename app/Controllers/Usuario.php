<?php

namespace App\Controllers;

class Usuario extends BaseController
{
    public function index()
    {
        session();
        return view('index');
    }

}