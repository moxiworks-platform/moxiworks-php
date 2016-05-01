<?php

class AgentTest extends PHPUnit_Framework_TestCase {
    public static function setUpBeforeClass() {
        \MoxiworksPlatform\Config::setUrl("https://api.moxiworks.com");
        \VCR\VCR::configure() ->setCassettePath(__DIR__ . '/fixtures');
        \VCR\VCR::configure() ->setMode('none');
        \VCR\VCR::turnOn();
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass() {
        \VCR\VCR::turnOff();
        parent::tearDownAfterClass();
    }


    public function setUp() {
        parent::setUp();
    }

    public function testFindThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('agent/find/success.yml');
        $agent = \MoxiworksPlatform\Agent::find(['moxi_works_agent_id' => 'abc123']);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('agent/find/nothing.yml');
        $agent = \MoxiworksPlatform\Agent::find(['moxi_works_agent_id' => 'abc123']);
        $this->assertNull($agent);
        \VCR\VCR::eject();
    }

    public function testReturnsAgentWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('agent/find/success.yml');
        $agent = \MoxiworksPlatform\Agent::find(['moxi_works_agent_id' => 'abc123']);
        $this->assertTrue(is_a($agent, '\MoxiworksPlatform\Agent'));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('agent/find/success.yml');
        $agent = \MoxiworksPlatform\Agent::search(['moxi_works_agent_id' => 'abc123']);
        \VCR\VCR::eject();

    }
    
}