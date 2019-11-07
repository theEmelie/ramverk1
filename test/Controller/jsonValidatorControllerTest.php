<?php

namespace Anax\IpController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class JsonValidatorControllerTest extends TestCase
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
        $this->controller = new JsonController();
        $this->controller->setDI($this->di);
        // $this->controller->initialize();
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $exp = "Validera en IP-adress med JSON format";
        $this->assertContains($exp, $body);
    }

    public function testIndexActionPostIPV4()
    {
        $_POST["ip"] = "8.8.8.8";
        $json = $this->controller->indexActionPost();
        $exp = '{"ip":"8.8.8.8","domain":"dns.google","valid":true,"status":"8.8.8.8 \u00e4r en giltig ipv4 adress."}';
        $this->assertEquals($exp, $json);
    }

    public function testIndexActionPostIPV6()
    {
        $_POST["ip"] = "2620:119:35::35";
        $json = $this->controller->indexActionPost();
        $exp = '{"ip":"2620:119:35::35","domain":"resolver1.opendns.com","valid":true,"status":"2620:119:35::35 \u00e4r en giltig ipv6 adress."}';
        $this->assertEquals($exp, $json);
    }

    public function testIndexActionPostInvalid()
    {
        $_POST["ip"] = "ABC.23.533";
        $json = $this->controller->indexActionPost();
        $exp = '{"ip":"ABC.23.533","domain":"","valid":false,"status":"ABC.23.533 \u00e4r en ogiltig ip adress."}';
        $this->assertEquals($exp, $json);
    }
    public function testApiCheckActionGetIPV4()
    {
        $_GET["ip"] = "8.8.8.8";
        $json = $this->controller->apiCheckActionGet();
        $exp = '{"ip":"8.8.8.8","domain":"dns.google","valid":true,"status":"8.8.8.8 \u00e4r en giltig ipv4 adress."}';
        $this->assertEquals($exp, $json);
    }

    public function testApiCheckActionGetIPV6()
    {
        $_GET["ip"] = "2620:119:35::35";
        $json = $this->controller->apiCheckActionGet();
        $exp = '{"ip":"2620:119:35::35","domain":"resolver1.opendns.com","valid":true,"status":"2620:119:35::35 \u00e4r en giltig ipv6 adress."}';
        $this->assertEquals($exp, $json);
    }

    public function testApiCheckActionGetInvalid()
    {
        $_GET["ip"] = "ABC.23.533";
        $json = $this->controller->apiCheckActionGet();
        $exp = '{"ip":"ABC.23.533","domain":"","valid":false,"status":"ABC.23.533 \u00e4r en ogiltig ip adress."}';
        $this->assertEquals($exp, $json);
    }

    public function testCatchAll()
    {
        $res = $this->controller->catchAll();
        $exp = "404 Not Found";
        $this->assertContains($exp, $res);
    }
}
