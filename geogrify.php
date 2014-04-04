<?php

class Geogrify
{
    protected $startX;
    protected $startY;
    protected $endX;
    protected $endY;

    public function getDistance()
    {
        return 'distance';
    }

    public function getBounds()
    {
        return 'bounds';
    }
}

////////////////////////////////////////////////
// Usage:
// $mo_distance = new DistanceAssistant();
// $mo_distance->Calculate($mf_latitude, $mf_longitude, $row['ZIPlLatitude'], $row['ZIPlLongitude']);

class DistanceAssistant {

    function DistanceAssistant() {
    }

    function Calculate($dblLat1, $dblLong1, $dblLat2, $dblLong2) {
        
        $EARTH_RADIUS_MILES = 3963;
        $dist = 0;

        // echo $dblLat1.", ".$dblLong1." vs ".$dblLat2.", ".$dblLong2."<br>";
        // echo ABS(($dblLat1 + 1) - $dblLat2);
        // die;

        // echo ABS($dblLat1 - $dblLat2)." : ".ABS($dblLong1 - $dblLong2)."<br><br>";
        // die;

        //convert degrees to radians
        $dblLat1 = $dblLat1 * M_PI / 180;
        $dblLong1 = $dblLong1 * M_PI / 180;
        $dblLat2 = $dblLat2 * M_PI / 180;
        $dblLong2 = $dblLong2 * M_PI / 180;
        
        //if ($dblLat1 != $dblLat2 || $dblLong1 != $dblLong2)
        //KRH
        if (ABS($dblLat1 - $dblLat2) > 0.00001 || ABS($dblLong1 - $dblLong2) > 0.00001)
        {
            //the two points are not the same
            $dist = 
                sin($dblLat1) * sin($dblLat2)
                + cos($dblLat1) * cos($dblLat2)
                * cos($dblLong2 - $dblLong1);

            $dist = 
                $EARTH_RADIUS_MILES
                * (-1 * atan($dist / sqrt(1 - $dist * $dist)) + M_PI / 2);
        }
        return $dist;
    }

}

////////////////////////////////////////////////
// Usage:
// $mo_radius = new RadiusAssistant($mf_latitude, $mf_longitude, $_member->radius);
// $ma_latitude['max'] = $mo_radius->MaxLatitude();
// $ma_latitude['min'] = $mo_radius->MinLatitude();
// $ma_longitude['max'] = $mo_radius->MaxLongitude();
// $ma_longitude['min'] = $mo_radius->MinLongitude();

class RadiusAssistant {

    var $maxLat;
    var $minLat;
    var $maxLong;
    var $minLong;

    function RadiusAssistant($Latitude, $Longitude, $Miles) {

        global $maxLat,$minLat,$maxLong,$minLong;

        $EQUATOR_LAT_MILE = 69.172;
        $maxLat = $Latitude + ($Miles / $EQUATOR_LAT_MILE);
        $minLat = $Latitude - ($maxLat - $Latitude);
        $maxLong = $Longitude + $Miles / (cos($minLat * M_PI / 180) * $EQUATOR_LAT_MILE);
        $minLong = $Longitude - ($maxLong - $Longitude);
    }

    function MaxLatitude() {
        return $GLOBALS["maxLat"];
    }

    function MinLatitude() {
        return $GLOBALS["minLat"];
    }

    function MaxLongitude() {
        return $GLOBALS["maxLong"];
    }

    function MinLongitude() {
        return $GLOBALS["minLong"];
    }

}