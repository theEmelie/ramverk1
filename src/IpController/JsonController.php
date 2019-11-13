<?php

namespace Anax\IpController;

use Anax\Models;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
class JsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $page = $this->di->get("page");

        $title = "Ip Validering";

        $json = [
            "ip" => "",
            "domain" => "",
            "valid" => "",
            "status" => "",
        ];

        $page->add("ip/apiCheck", [
            "json" => $json,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function indexActionPost()
    {
        $request = $this->di->get("request");
        $ips = $request->getPost("ip");

        $ipAdress = new Models\IpValidate;

        $json = $ipAdress->validate($ips);

        return json_encode($json);
    }

    public function apiCheckActionGet()
    {
        $request = $this->di->get("request");
        $ips = $request->getGet("ip");

        $ipAdress = new Models\IpValidate;

        $json = $ipAdress->validate($ips);

        return json_encode($json);
    }

    /**
    * @SuppressWarnings(PHPMD.UnusedFormalParameter)
    */
    public function catchAll(...$args)
    {
        // Deal with the request and send an actual response, or not.
        //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
        return "404 Not Found";
    }
}
