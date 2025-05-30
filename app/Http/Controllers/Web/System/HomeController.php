<?php

namespace App\Http\Controllers\Web\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $data = [];
    
    public function index(){

        return view('pages.home.index', $this->data);
    }
}
