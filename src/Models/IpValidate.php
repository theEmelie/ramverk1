<?php

namespace Anax\Models;

use Anax\Config\tokens;

class IpValidate
{
    public function validate($ips)
    {
        $valid = "";
        $domain = "";
        $status = "";
        $ipStackData = "";
        $accessKey = 'a5be17bdd41b97453018da83e4708650';

        if (filter_var($ips, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $status = $ips . " är en giltig ipv4 adress.";
            $valid = true;
            $domain = gethostbyaddr($ips);
            $ipStackUrl = 'http://api.ipstack.com/' . $ips . '?access_key=' . $accessKey . '';
            $curlObj = new Curl;
            $ipStackData = json_decode($curlObj->curl($ipStackUrl));
        } else if (filter_var($ips, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $status = $ips . " är en giltig ipv6 adress.";
            $valid = true;
            $domain = gethostbyaddr($ips);
            $ipStackUrl = 'http://api.ipstack.com/' . $ips . '?access_key=' . $accessKey . '';
            $curlObj = new Curl;
            $ipStackData = json_decode($curlObj->curl($ipStackUrl));
        } else {
            $valid = false;
            $status = $ips . " är en ogiltig ip adress.";
        }

        $json = [
            "ip" => $ips,
            "domain" => $domain,
            "valid" => $valid,
            "status" => $status,
            "ipStackData" => $ipStackData,
        ];

        return $json;
    }
}
