<?php

namespace Anax\Models;

class Weather
{
    public function getWeatherGeo($lat, $long, $weather)
    {
        $accessKey = 'd64f9e8764e614f8e8b2f72bfe680af0';

        if ($weather == "futureWeather") {
            $darkSkyUrl = 'https://api.darksky.net/forecast/' . $accessKey . "/" . $lat . "," . $long . "?units=si";
            $curlObj = new Curl;
            $darkSkyData = json_decode($curlObj->curl($darkSkyUrl));

        } else {
            // Past weather
            $numberOfDays = 30;
            for ($i = 0; $i < $numberOfDays; $i++) {
                $timestr = "-" . $i . " day";
                $time = strtotime($timestr, time());
                $urls[$i] = 'https://api.darksky.net/forecast/' . $accessKey . "/" . $lat . "," . $long . "," . $time . "?units=si";
            }
            // var_dump($urls);
            $curlObj = new Curl;
            $curlOutput = $curlObj->multiCurl($urls);
            for ($i = 0; $i < $numberOfDays; $i++) {
                $darkSkyData[$i] = json_decode($curlOutput[$i]);
            }
        }

        $json = [
            "weather" => $weather,
            "darkSkyData" => $darkSkyData,
        ];

        return $json;
    }
}
