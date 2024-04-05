<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller {

    public function createCity(Request $request) {

        $city = new City;
            $city -> city = $request["city"];
            

            $city -> save();
            return $city;

    }
}
