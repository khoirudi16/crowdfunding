<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserpageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('emailverify');
    }

    public function index()
    {
        return view('user');
    }
}
