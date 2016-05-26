<?php

class GroupTest extends PHPUnit_Framework_TestCase {
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
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setSecret(null);
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('group/find/success.yml');
        $group = \MoxiworksPlatform\Group::find(['moxi_works_agent_id' => 'abc123', 'moxi_works_group_name' => 'foobar']);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('group/find/nothing.yml');
        $group = \MoxiworksPlatform\Group::find(['moxi_works_agent_id' => 'abc123', 'moxi_works_group_name' => 'foobar']);
        $this->assertNull($group);
        \VCR\VCR::eject();
    }

    public function testReturnsGroupWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('group/find/success.yml');
        $group = \MoxiworksPlatform\Group::find(['moxi_works_agent_id' => 'abc123', 'moxi_works_group_name' => 'foobar']);
        $this->assertTrue(is_a($group, '\MoxiworksPlatform\Group'));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('group/find/success.yml');
        $group = \MoxiworksPlatform\Group::find();
        \VCR\VCR::eject();
    }
    
    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setSecret(null);
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('group/search/success.yml');
        $group = \MoxiworksPlatform\Group::search(['moxi_works_agent_id' => 'abc123']);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('group/search/nothing.yml');
        $group = \MoxiworksPlatform\Group::search(['moxi_works_agent_id' => 'abc123']);
        $this->assertTrue(empty($group));
        \VCR\VCR::eject();
    }

    public function testSearchReturnsGroupsWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('group/search/success.yml');
        $groups = \MoxiworksPlatform\Group::search(['moxi_works_agent_id' => 'abc123']);
        $this->assertTrue(is_array($groups));
        \VCR\VCR::eject();
    }

    public  function searchThrowsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('group/find/success.yml');
        $group = \MoxiworksPlatform\Group::search();
        \VCR\VCR::eject();
    }

}