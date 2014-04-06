geogriffy
=========

A class to simplify dealing with coordinates and distance.

$ringgold    = new Geogriffy(34.911342,-85.1421489);
$chattanooga = new Geogriffy(35.0982955,-85.2386909);

$ringgold->bounds(5);
$ringgold->distance($chattanooga);