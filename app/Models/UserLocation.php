<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserLocation extends Model
{
    use HasFactory;


    // https://stackoverflow.com/questions/37876166/haversine-distance-calculation-between-two-points-in-laravel
    
    public static function getNearBy(
        $lat,
        $lng,
        $distance,
        $distanceIn = 'miles'
    ) {
        if ($distanceIn == 'km') {
            $results = self::select([
                '*',
                DB::raw(
                    '( 0.621371 * 3959 * acos( cos( radians(' . $lat . ') ) 
                    * cos( radians( lat ) ) 
                    * cos( radians( lng ) - radians(' . $lng . ') ) 
                    + sin( radians(' . $lat . ') ) 
                    * sin( radians(lat) ) ) ) AS distance'
                )
            ])
                // ->havingRaw('distance < ' . $distance)
                ->get();
        } else {
            $results = self::select([
                '*',
                DB::raw(
                    '( 3959 * acos( cos( radians(' . $lat . ') ) 
                    * cos( radians( lat ) ) 
                    * cos( radians( lng ) - radians(' . $lng . ') ) 
                    + sin( radians(' . $lat . ') ) 
                    * sin( radians(lat) ) ) ) AS distance'
                )
            ])
                // ->havingRaw('distance < ' . $distance)
                ->get();
        }
        return $results;
    }
}
