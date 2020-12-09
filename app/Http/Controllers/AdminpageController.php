<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminpageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('emailverify');
        $this->middleware('isadmin');
    }

    public function index()
    {
        return view('admin');
    }
}
