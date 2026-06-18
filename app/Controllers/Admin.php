<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function panel()
    {
        return view('panelAdmin');
    }

}