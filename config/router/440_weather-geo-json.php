<?php
/**
 * A controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Json Controller.",
            "mount" => "geoWeatherJson",
            "handler" => "\Anax\IpController\GeoWeatherJsonController",
        ],
    ]
];
