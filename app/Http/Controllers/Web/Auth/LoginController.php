<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.authentication.index');
    }

    public function store(Request $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index');
        } else {
            Auth::logout();
            return back()->with("toast_error", "verifique se o email e senha foram digitados corretamente.")->withInput();
        }

        return back()->with("toast_error", "verifique se o email e senha foram digitados corretamente.")->withInput();
    }

    public function reset()
    {
        return view('pages.authentication.reset');
    }
}
