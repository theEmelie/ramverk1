<?php

namespace Anax\IpController;

use Anax\Models;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


/**
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class GeoWeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function indexActionGet()
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");

        $title = "Väderprognos";

        $json = [
            "ip" => $request->getServer("REMOTE_ADDR", ""),
            "status" => "",
        ];

        $page->add("weather/showWeather", [
            "weatherJson" => $json,
            "dataExists" => false,
            "status" => "Ingen data tillgänglig",
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function indexActionPost()
    {
        $title = "Väderprognos";
        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $location = $request->getPost("location");
        $futureOrPast = $request->getPost("weather");

        $ipAdress = new Models\IpValidate;
        $weather = new Models\Weather;

        $json = $ipAdress->validate($location);

        if ($json["valid"] == true) {
            $weatherJson = $weather->getWeatherGeo($json["ipStackData"]->{"latitude"}, $json["ipStackData"]->{"longitude"}, $futureOrPast);
            $dataExists = true;
            $status = "";
        } else {
            $latLong = explode(",", $location);
            if (count($latLong) == 2 && is_int($latLong[0]) && is_int($latLong[1])) {
                if ($latLong[0] <= 90 && $latLong[0] >= -90 && $latLong[1] >= -180 && $latLong[1] <= 180) {
                    $weatherJson = $weather->getWeatherGeo($latLong[0], $latLong[1], $futureOrPast);
                    $dataExists = true;
                    $status = "";
                } else {
                    $weatherJson = "";
                    $dataExists = false;
                    $status = "Okänd plats";
                }
            } else {
                $weatherJson = "";
                $dataExists = false;
                $status = "Användar error!";
            }
        }

        $page->add("weather/showWeather", [
            "weatherJson" => $weatherJson,
            "dataExists" => $dataExists,
            "status" => $status,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * Adding an optional catchAll() method will catch all actions sent to the
     * router. You can then reply with an actual response or return void to
     * allow for the router to move on to next handler.
     * A catchAll() handles the following, if a specific action method is not
     * created:
     * ANY METHOD mountpoint/**
     *
     * @param array $args as a variadic parameter.
     *
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function catchAll(...$args)
    {
        // Deal with the request and send an actual response, or not.
        //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
        return;
    }
}
