<?php

namespace Anax\IpController;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpAdressController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet()
    {
        $page = $this->di->get("page");

        $title = "Ip Validering";

        $json = [
            "ip" => "",
            "domain" => "",
            "valid" => "",
            "status" => "",
        ];

        $page->add("ip/ipCheck", [
            "json" => $json,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function indexActionPost()
    {
        $request = $this->di->get("request");
        $page = $this->di->get("page");

        $ips = $request->getPost("ip");
        $valid = "";
        $domain = "";
        $status = "";

        if (filter_var($ips, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $status = $ips . " är en giltig ipv4 adress.";
            $valid = true;
            $domain = "Domän namn: " . gethostbyaddr($ips);
        } else if (filter_var($ips, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $status = $ips . " är en giltig ipv6 adress.";
            $valid = true;
            $domain =  "Domän namn: " . gethostbyaddr($ips);
        } else {
            $valid = false;
            $status = $ips . " är en ogiltig ip adress.";
        }

        $json = [
            "ip" => $ips,
            "domain" => $domain,
            "valid" => $valid,
            "status" => $status,
        ];

        $page->add("ip/ipCheck", [
            "json" => $json,
        ]);

        return $page->render([]);
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
