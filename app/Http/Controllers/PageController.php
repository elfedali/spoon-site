<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    // home
    public function home()
    {
        return view('pages.home');
    }
    // details
    public function details()
    {
        return view('pages.details');
    }
}
