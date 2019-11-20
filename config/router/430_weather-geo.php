<?php
/**
 * A controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Controller.",
            "mount" => "geoWeather",
            "handler" => "\Anax\IpController\GeoWeatherController",
        ],
    ]
];
