<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {

        $places = Place::all();
        return view('welcome', compact('places'));
    }
}
