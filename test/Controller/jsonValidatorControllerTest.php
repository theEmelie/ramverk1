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
        $exp = '{"ip":"8.8.8.8","domain":"dns.google","valid":true,"status":"8.8.8.8 \u00e4r en giltig ipv4 adress.","ipStackData":{"ip":"8.8.8.8","type":"ipv4","continent_code":"NA","continent_name":"North America","country_code":"US","country_name":"United States","region_code":"CA","region_name":"California","city":"Mountain View","zip":"94043","latitude":37.419158935546875,"longitude":-122.07540893554688,"location":{"geoname_id":5375480,"capital":"Washington D.C.","languages":[{"code":"en","name":"English","native":"English"}],"country_flag":"http:\/\/assets.ipstack.com\/flags\/us.svg","country_flag_emoji":"\ud83c\uddfa\ud83c\uddf8","country_flag_emoji_unicode":"U+1F1FA U+1F1F8","calling_code":"1","is_eu":false}}}';
        $this->assertEquals($exp, $json);
    }

    public function testIndexActionPostIPV6()
    {
        $_POST["ip"] = "2620:119:35::35";
        $json = $this->controller->indexActionPost();
        $exp = '{"ip":"2620:119:35::35","domain":"resolver1.opendns.com","valid":true,"status":"2620:119:35::35 \u00e4r en giltig ipv6 adress.","ipStackData":{"ip":"2620:119:35::35","type":"ipv6","continent_code":"NA","continent_name":"North America","country_code":"US","country_name":"United States","region_code":"CA","region_name":"California","city":"San Francisco","zip":"94107","latitude":37.775001525878906,"longitude":-122.41832733154297,"location":{"geoname_id":5391959,"capital":"Washington D.C.","languages":[{"code":"en","name":"English","native":"English"}],"country_flag":"http:\/\/assets.ipstack.com\/flags\/us.svg","country_flag_emoji":"\ud83c\uddfa\ud83c\uddf8","country_flag_emoji_unicode":"U+1F1FA U+1F1F8","calling_code":"1","is_eu":false}}}';
        $this->assertEquals($exp, $json);
    }

    public function testIndexActionPostInvalid()
    {
        $_POST["ip"] = "ABC.23.533";
        $json = $this->controller->indexActionPost();
        $exp = '{"ip":"ABC.23.533","domain":"","valid":false,"status":"ABC.23.533 \u00e4r en ogiltig ip adress.","ipStackData":""}';
        $this->assertEquals($exp, $json);
    }
    public function testApiCheckActionGetIPV4()
    {
        $_GET["ip"] = "8.8.8.8";
        $json = $this->controller->apiCheckActionGet();
        $exp = '{"ip":"8.8.8.8","domain":"dns.google","valid":true,"status":"8.8.8.8 \u00e4r en giltig ipv4 adress.","ipStackData":{"ip":"8.8.8.8","type":"ipv4","continent_code":"NA","continent_name":"North America","country_code":"US","country_name":"United States","region_code":"CA","region_name":"California","city":"Mountain View","zip":"94043","latitude":37.419158935546875,"longitude":-122.07540893554688,"location":{"geoname_id":5375480,"capital":"Washington D.C.","languages":[{"code":"en","name":"English","native":"English"}],"country_flag":"http:\/\/assets.ipstack.com\/flags\/us.svg","country_flag_emoji":"\ud83c\uddfa\ud83c\uddf8","country_flag_emoji_unicode":"U+1F1FA U+1F1F8","calling_code":"1","is_eu":false}}}';
        $this->assertEquals($exp, $json);
    }

    public function testApiCheckActionGetIPV6()
    {
        $_GET["ip"] = "2620:119:35::35";
        $json = $this->controller->apiCheckActionGet();
        $exp = '{"ip":"2620:119:35::35","domain":"resolver1.opendns.com","valid":true,"status":"2620:119:35::35 \u00e4r en giltig ipv6 adress.","ipStackData":{"ip":"2620:119:35::35","type":"ipv6","continent_code":"NA","continent_name":"North America","country_code":"US","country_name":"United States","region_code":"CA","region_name":"California","city":"San Francisco","zip":"94107","latitude":37.775001525878906,"longitude":-122.41832733154297,"location":{"geoname_id":5391959,"capital":"Washington D.C.","languages":[{"code":"en","name":"English","native":"English"}],"country_flag":"http:\/\/assets.ipstack.com\/flags\/us.svg","country_flag_emoji":"\ud83c\uddfa\ud83c\uddf8","country_flag_emoji_unicode":"U+1F1FA U+1F1F8","calling_code":"1","is_eu":false}}}';
        $this->assertEquals($exp, $json);
    }

    public function testApiCheckActionGetInvalid()
    {
        $_GET["ip"] = "ABC.23.533";
        $json = $this->controller->apiCheckActionGet();
        $exp = '{"ip":"ABC.23.533","domain":"","valid":false,"status":"ABC.23.533 \u00e4r en ogiltig ip adress.","ipStackData":""}';
        $this->assertEquals($exp, $json);
    }

    public function testCatchAll()
    {
        $res = $this->controller->catchAll();
        $exp = "404 Not Found";
        $this->assertContains($exp, $res);
    }
}
