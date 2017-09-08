<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;

class PharmacyController extends Controller
{
    public function index()
    {
        return Pharmacy::all();
    }

    public function nearest($lat, $long) {
        $pharmacy = new Pharmacy;
        $query = 'name, address, city, state, zip, ( 3959 * acos( cos( radians(?) ) * cos( radians( latitude ) ) 
* cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin(radians(latitude)) ) ) AS distance ';
        $result = $pharmacy->selectRaw($query, array($lat, $long, $lat))
            ->orderBy('distance', 'asc')
            ->limit(1);
        return $result->get()[0];
    }
}