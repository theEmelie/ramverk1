<?php

namespace Anax\IpController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class IpValidatorControllerTest extends TestCase
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
        $this->controller = new IpAdressController();
        $this->controller->setDI($this->di);
        // $this->controller->initialize();
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $body = $res->getBody();
        $exp = "Validera en IP-adress";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostIPV4()
    {
        $_POST["ip"] = "8.8.8.8";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "8.8.8.8 är en giltig ipv4 adress.";
        $this->assertContains($exp, $body);
        $exp = "dns.google";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostIPV6()
    {
        $_POST["ip"] = "2620:119:35::35";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "2620:119:35::35 är en giltig ipv6 adress.";
        $this->assertContains($exp, $body);
        $exp = "resolver1.opendns.com";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostInvalid()
    {
        $_POST["ip"] = "23..23.44.22";
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $exp = "23..23.44.22 är en ogiltig ip adress.";
        $this->assertContains($exp, $body);
    }

    public function testCatchAll()
    {
        $res = $this->controller->catchAll();
        $exp = "404 Not Found";
        $this->assertContains($exp, $res);
    }
}
