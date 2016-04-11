<?php


class ConfigTest extends PHPUnit_Framework_TestCase {

    public function testUrlDefaultIsSet() {
        $url = \MoxiworksPlatform\Config::getUrl();
        $this->assertNotNull($url);
    }

    public function testUrlDefaultIsString() {
        $url = \MoxiworksPlatform\Config::getUrl();
        $this->assertTrue(is_string($url));
    }

    public function testAllowsSettingUrl() {
        $initial_url = \MoxiworksPlatform\Config::getUrl();
        MoxiworksPlatform\Config::setUrl("http://foo.bar");
        $updated_url = \MoxiworksPlatform\Config::getUrl();
        $this->assertNotEquals($updated_url, $initial_url);
    }

    public  function testReturnsSameValueSet() {
        $updated_url = "http://whatevers.2009.com";
        MoxiworksPlatform\Config::setUrl($updated_url);
        $new_url_val = \MoxiworksPlatform\Config::getUrl();
        $this->assertEquals($updated_url, $new_url_val);
    }

    public  function testDebugIsNotTrueByDefault() {
        $this->assertNotTrue(\MoxiworksPlatform\Config::getDebug());
    }

    public function testDebugIsNullByDefault() {
        $this->assertFalse(\MoxiworksPlatform\Config::getDebug());
    }

    public function testSettingDebugValue() {
        $initial = \MoxiworksPlatform\Config::getDebug();
        MoxiworksPlatform\Config::setDebug(true);
        $updated = \MoxiworksPlatform\Config::getDebug();
        $this->assertNotEquals($initial, $updated);
    }

    public function testReturnsSameDebugValueAsWasSet() {
        MoxiworksPlatform\Config::setDebug(true);
        $this->assertTrue(\MoxiworksPlatform\Config::getDebug());
    }

    public function testSettingWithNotBooleanMakesFalse() {
        MoxiworksPlatform\Config::setDebug('whatevers 2009');
        $this->assertFalse(\MoxiworksPlatform\Config::getDebug());
    }

}
