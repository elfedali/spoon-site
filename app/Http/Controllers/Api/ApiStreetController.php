<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class ApiStreetController extends Controller
{
    public function index(Request $request, City $city)
    {
        return response()->json($city->streets()
            ->select('id', 'name')
            ->get()->toArray());
    }
}
