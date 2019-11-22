<?php

namespace Anax\IpController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the WeatherJsonController.
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class WeatherJsonControllerTest extends TestCase
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
        $this->controller = new GeoWeatherJsonController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    // Test inserting that body contains a string.
    public function testIndexActionGet()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $exp = "Kolla vädret med JSON format";
        $this->assertContains($exp, $body);
    }

    // Test inserting IPV4 adress with future weather
    public function testIndexActionPostIPV4()
    {
        $_POST["location"] = "8.8.8.8";
        $_POST["weather"] = "futureWeather";
        $json = $this->controller->indexActionPost();
        $exp = '{"weatherJson":{"weather":"futureWeather","darkSkyData":{"latitude":37.419158935547,"longitude":-122.07540893555,"timezone":"America\/Los_Angeles"';
        $this->assertContains($exp, $json);
    }

    // Test inserting IPV4 adress with past weather
    public function testIndexActionPostIPV4Past()
    {
        $_POST["location"] = "8.8.8.8";
        $_POST["weather"] = "pastWeather";
        $json = $this->controller->indexActionPost();
        $exp = '{"weatherJson":{"weather":"pastWeather","darkSkyData":[{"latitude":37.419158935547,"longitude":-122.07540893555,';
        $this->assertContains($exp, $json);
    }

    // Test inserting IPV6 adress with future weather
    public function testIndexActionPostIPV6()
    {
        $_POST["location"] = "2620:119:35::35";
        $_POST["weather"] = "futureWeather";
        $json = $this->controller->indexActionPost();
        $exp = '{"weatherJson":{"weather":"futureWeather","darkSkyData":{"latitude":37.775001525879,"longitude":-122.41832733154';
        $this->assertContains($exp, $json);
    }

    // Test inserting IPV6 adress with past weather
    public function testIndexActionPostIPV6Past()
    {
        $_POST["location"] = "2620:119:35::35";
        $_POST["weather"] = "pastWeather";
        $json = $this->controller->indexActionPost();
        $exp = '{"weatherJson":{"weather":"pastWeather","darkSkyData":[{"latitude":37.775001525879,"longitude":-122.41832733154,';
        $this->assertContains($exp, $json);
    }

    // Test inserting coordinates with future weather
    public function testIndexActionPostCord()
    {
        $_POST["location"] = "48.8584, -2.2945";
        $_POST["weather"] = "futureWeather";
        $json = $this->controller->indexActionPost();
        $exp = '{"weatherJson":{"weather":"futureWeather","darkSkyData":{"latitude":48.8584,"longitude":-2.2945';
        $this->assertContains($exp, $json);
    }

    // Test inserting coordinates with past weather
    public function testIndexActionPostCordPast()
    {
        $_POST["location"] = "48.8584, -2.2945";
        $_POST["weather"] = "pastWeather";
        $json = $this->controller->indexActionPost();
        $exp = '{"weatherJson":{"weather":"pastWeather","darkSkyData":[{"latitude":48.8584,"longitude":-2.2945';
        $this->assertContains($exp, $json);
    }

    // Test inserting unknown coordinates with past weather
    public function testIndexActionPostInvalid()
    {
        $_POST["location"] = "5000, 5000";
        $_POST["weather"] = "pastWeather";
        $json = $this->controller->indexActionPost();
        $exp = '{"weatherJson":"","dataExists":false,"status":"Ok\u00e4nd plats"}';
        $this->assertContains($exp, $json);
    }

    // Test get IPV4 adress with future weather
    public function testWeatherCheckActionGetIPV4()
    {
        $_GET["location"] = "8.8.8.8";
        $_GET["weather"] = "futureWeather";
        $json = $this->controller->weatherCheckActionGet();
        $exp = '{"weatherJson":{"weather":"futureWeather","darkSkyData":{"latitude":37.419158935547,"longitude":-122.07540893555';
        $this->assertContains($exp, $json);
    }

    // Test get IPV4 adress with past weather
    public function testWeatherCheckActionGetIPV4Past()
    {
        $_GET["location"] = "8.8.8.8";
        $_GET["weather"] = "pastWeather";
        $json = $this->controller->weatherCheckActionGet();
        $exp = '{"weatherJson":{"weather":"pastWeather","darkSkyData":[{"latitude":37.419158935547,"longitude":-122.07540893555';
        $this->assertContains($exp, $json);
    }

    // Test get IPV6 adress with future weather
    public function testWeatherCheckActionGetIPV6()
    {
        $_GET["location"] = "2620:119:35::35";
        $_GET["weather"] = "futureWeather";
        $json = $this->controller->weatherCheckActionGet();
        $exp = '{"weatherJson":{"weather":"futureWeather","darkSkyData":{"latitude":37.775001525879,"longitude":-122.41832733154';
        $this->assertContains($exp, $json);
    }

    // Test get IPV6 adress with past weather
    public function testWeatherCheckActionGetIPV6Past()
    {
        $_GET["location"] = "2620:119:35::35";
        $_GET["weather"] = "pastWeather";
        $json = $this->controller->weatherCheckActionGet();
        $exp = '{"weatherJson":{"weather":"pastWeather","darkSkyData":[{"latitude":37.775001525879,"longitude":-122.41832733154';
        $this->assertContains($exp, $json);
    }

    // Test get coordinates with future weather
    public function testWeatherCheckActionGetCord()
    {
        $_GET["location"] = "48.8584, -2.2945";
        $_GET["weather"] = "futureWeather";
        $json = $this->controller->weatherCheckActionGet();
        $exp = '{"weatherJson":{"weather":"futureWeather","darkSkyData":{"latitude":48.8584,"longitude":-2.2945';
        $this->assertContains($exp, $json);
    }

    // Test get coordinates with past weather
    public function testWeatherCheckActionGetCordPast()
    {
        $_GET["location"] = "48.8584, -2.2945";
        $_GET["weather"] = "pastWeather";
        $json = $this->controller->weatherCheckActionGet();
        $exp = '{"weatherJson":{"weather":"pastWeather","darkSkyData":[{"latitude":48.8584,"longitude":-2.2945';
        $this->assertContains($exp, $json);
    }

    // Test get unknown coordinates with past weather
    public function testWeatherCheckActionGetInvalidCordPast()
    {
        $_GET["location"] = "5000, 5000";
        $_GET["weather"] = "pastWeather";
        $json = $this->controller->weatherCheckActionGet();
        $exp = '{"weatherJson":"","dataExists":false,"status":"Ok\u00e4nd plats"}';
        $this->assertContains($exp, $json);
    }
}
