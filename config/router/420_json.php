<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Json Controller.",
            "mount" => "jsonValidate",
            "handler" => "\Anax\IpController\JsonController",
        ],
    ]
];
