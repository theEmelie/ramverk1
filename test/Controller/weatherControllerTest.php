<?php

namespace Anax\IpController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the WeatherController.
 */
class WeatherControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new GeoWeatherController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $body = $res->getBody();
        $exp = "Kolla vädret för en plats";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostIPV4()
    {
        $_POST["location"] = "8.8.8.8";
        $_POST["weather"] = "futureWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Vädersummering";
        $this->assertContains($exp, $body);
        $exp = "1350, Shorebird Way, Shoreline Business Park, Mountain View, Santa Clara County, California, 94043, United States";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostIPV6()
    {
        $_POST["location"] = "2620:119:35::35";
        $_POST["weather"] = "futureWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Vädersummering";
        $this->assertContains($exp, $body);
        $exp = "San Francisco";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostIPV4Past()
    {
        $_POST["location"] = "8.8.8.8";
        $_POST["weather"] = "pastWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Vädersummering";
        $this->assertContains($exp, $body);
        $exp = "1350, Shorebird Way, Shoreline Business Park, Mountain View, Santa Clara County, California, 94043, United States";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostIPV6Past()
    {
        $_POST["location"] = "2620:119:35::35";
        $_POST["weather"] = "pastWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Vädersummering";
        $this->assertContains($exp, $body);
        $exp = "San Francisco";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostCord()
    {
        $_POST["location"] = "48.8584,-2.2945";
        $_POST["weather"] = "futureWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Vädersummering";
        $this->assertContains($exp, $body);
        $exp = "France métropolitaine, France";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostCordPast()
    {
        $_POST["location"] = "48.8584,-2.2945";
        $_POST["weather"] = "pastWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Vädersummering";
        $this->assertContains($exp, $body);
        $exp = "France métropolitaine, France";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostInvalid()
    {
        $_POST["location"] = "23..23.44.22";
        $_POST["weather"] = "futureWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Användar error!";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostInvalidPast()
    {
        $_POST["location"] = "5000,5000";
        $_POST["weather"] = "pastWeather";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "Okänd plats";
        $this->assertContains($exp, $body);
    }
}
