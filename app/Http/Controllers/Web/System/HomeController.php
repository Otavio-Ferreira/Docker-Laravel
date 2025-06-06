<?php

namespace App\Http\Controllers\Web\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $data = [];

    public function index()
    {
        $this->data['user'] = Auth::user();

        $diff = $this->data['user']->updated_at->diffInMonths();

        if ($diff < 1) {
            $progress = '100%';
        } elseif ($diff < 2) {
            $progress = '90%';
        } elseif ($diff < 3) {
            $progress = '60%';
        } elseif ($diff < 4) {
            $progress = '50%';
        } elseif ($diff < 5) {
            $progress = '40%';
        } elseif ($diff < 6) {
            $progress = '30%';
        } elseif ($diff < 7) {
            $progress = '20%';
        } elseif ($diff < 8) {
            $progress = '10%';
        } else {
            $progress = '1%';
        }

        $this->data['progress'] = $progress;
        $this->data['diff'] = $diff;

        $profile = 100;

        if($this->data['user']->cpf == null){
            $profile -= 20;
        }
        if($this->data['user']->birth == null){
            $profile -= 20;
        }
        if($this->data['user']->phone == null){
            $profile -= 20;
        }

        $this->data['profile'] = $profile;

        return view('pages.home.index', $this->data);
    }
}
