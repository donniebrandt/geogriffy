<?php

class Geogriffy
{
    protected $latitude;
    protected $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    public function bounds($radius)
    {
        $equatorLatMiles = 69.172;

        $bounds['maxLatitude']  = $this->latitude + ($radius / $equatorLatMiles);
        $bounds['minLatitude']  = $this->latitude - ($bounds['maxLatitude'] - $this->latitude);
        $bounds['maxLongitude'] = $this->longitude + $radius / (cos($bounds['minLatitude'] * M_PI / 180) * $equatorLatMiles);
        $bounds['minLongitude'] = $this->longitude - ($bounds['maxLongitude'] - $this->longitude);

        return $bounds;
    }

    public function distance(Geogriffy $endPoint)
    {
        $earthRadiusMiles = 3963;
        $distance         = 0;

        // Degrees to radians
        $startPointLatRad  = $this->latitude * M_PI / 180;
        $startPointLongRad = $this->longitude * M_PI / 180;
        $endPointLatRad    = $endPoint->latitude * M_PI / 180;
        $endPointLongRad   = $endPoint->longitude * M_PI / 180;

        // Disparate points?
        if (ABS($startPointLatRad - $endPointLatRad) > 0.00001 || ABS($startPointLongRad - $endPointLongRad) > 0.00001) {
            $distance =
                sin($startPointLatRad) * sin($endPointLatRad)
                + cos($startPointLatRad) * cos($endPointLatRad)
                * cos($endPointLongRad - $startPointLongRad);

            $distance =
                $earthRadiusMiles
                * (-1 * atan($distance / sqrt(1 - $distance * $distance)) + M_PI / 2);
        }

        return $distance;
    }
}
