Geogriffy
=========

Geogriffy is a class to simplify dealing with coordinates and distance.

## Get Started

To instantiate a new location, simply provide your coordinates:

```
    $ringgold = new Geogriffy(34.911342, -85.1421489);
```

The `bounds()` method generates a geographic window based on a radius which will assist you in searches. The values returned are `maxLatitude`, `minLatitude`, `maxLongitude`, and `minLongitude`. Radius currently supports miles--not kilometers.

```
    $ringgold->bounds(5);
```

Once in a blue moon, you may find that you need to calculate distance. If so, you can handle it like this:

```
    $chattanooga = new Geogriffy(35.0982955, -85.2386909);
    $ringgold->distance($chattanooga);
```