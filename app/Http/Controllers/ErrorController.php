<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index()
    {
        return view('errors.index');
    }

    public function activationerror()
    {
        return view('errors.emailactivation');
    }

    public function notauthorized()
    {
        return view('errors.notauthorized');
    }
}
