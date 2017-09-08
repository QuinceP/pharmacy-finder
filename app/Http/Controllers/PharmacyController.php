<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;
use Exception;

class PharmacyController extends Controller
{
    public function nearest($lat, $long)
    {
        $json = ['status' => 1];
        try {
            $pharmacy = new Pharmacy;
            // distance is calculated using the Haversine Formula
            // source: https://developers.google.com/maps/solutions/store-locator/clothing-store-locator
            $query = 'name, address, city, state, zip, 
            (3959 * acos( cos(radians(?)) * cos(radians(latitude)) 
            * cos(radians( longitude) - radians(?)) + sin( radians(?)) * sin(radians(latitude)))) 
            AS distance ';
            $result = $pharmacy->selectRaw($query, array($lat, $long, $lat))
                ->orderBy('distance', 'asc')
                ->limit(1);
            $resultArray = $result->get()[0];
            $json['result'] = [
                'name' => $resultArray['name'],
                'address' => sprintf('%s, %s, %s %d', $resultArray['address'], $resultArray['city'],
                    $resultArray['state'], $resultArray['zip']),
                'distance' => $resultArray['distance']
            ];
        } catch (Exception $e) {
            $json['error'] = ['code' => $e->getCode(), 'message' => $e->getMessage()];
            $json['status'] = 0;
        }
        return $json;
    }
}