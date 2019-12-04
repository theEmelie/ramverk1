<?php
/**
 * A controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Json Controller.",
            "mount" => "weatherJson",
            "handler" => "\Anax\IpController\GeoWeatherJsonController",
        ],
    ]
];
