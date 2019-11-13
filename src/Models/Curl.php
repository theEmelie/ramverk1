<?php

namespace Anax\Models;

class Curl
{
    public function curl($url)
    {
          // Initialize CURL:
          $curlHandle = curl_init($url);
          curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);

          // Store the data:
          $json = curl_exec($curlHandle);
          curl_close($curlHandle);

          return $json;
    }
}
