<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Simulasi Study'; 
        return view('index', $data);
    }
}
