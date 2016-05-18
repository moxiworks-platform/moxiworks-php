<?php

class EventTest extends PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        \MoxiworksPlatform\Config::setUrl("https://api.moxiworks.com");
        \VCR\VCR::configure()->setCassettePath(__DIR__ . '/fixtures');
        \VCR\VCR::configure()->setMode('none');
        \VCR\VCR::turnOn();
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass()
    {
        \VCR\VCR::turnOff();
        parent::tearDownAfterClass();
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        \MoxiworksPlatform\Credentials::setSecret(null);
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setInstance(null);
        parent::tearDown();
    }


    public function testSaveThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('event/update/success.yml');
        $event = new \MoxiworksPlatform\Event(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $event->save();
        \VCR\VCR::eject();
    }

    public function testSaveReturnsEventObjectWhenSaveIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/update/success.yml');
        $event = new \MoxiworksPlatform\Event(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $response = $event->save();
        $this->assertTrue(is_a($response, '\MoxiworksPlatform\Event'));
        \VCR\VCR::eject();
    }

    public function testSaveThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/update/fail.yml');
        $event = new \MoxiworksPlatform\Event(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $response = $event->save();
        \VCR\VCR::eject();
    }

    public function testDeleteThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('event/delete/success.yml');
        $event = new \MoxiworksPlatform\Event(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $event->delete();
        \VCR\VCR::eject();
    }

    public function testDeleteReturnsEventObjectWhenDeleteIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/delete/success.yml');
        $event = new \MoxiworksPlatform\Event(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $response = $event->delete();
        $this->assertTrue(is_a($response, '\MoxiworksPlatform\Event'));
        \VCR\VCR::eject();
    }

    public function testDeleteThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/delete/fail.yml');
        $event = new \MoxiworksPlatform\Event(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $response = $event->delete();
        \VCR\VCR::eject();
    }

    public function testFindThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('event/find/success.yml');
        $event = \MoxiworksPlatform\Event::find(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/find/nothing.yml');
        $event = \MoxiworksPlatform\Event::find(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $this->assertNull($event);
        \VCR\VCR::eject();
    }

    public function testReturnsEventWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/find/success.yml');
        $event = \MoxiworksPlatform\Event::find(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $this->assertTrue(is_a($event, '\MoxiworksPlatform\Event'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('event/update/success.yml');
        $event = \MoxiworksPlatform\Event::update(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testUpdateReturnsEventObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/update/success.yml');
        $event = \MoxiworksPlatform\Event::update(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $this->assertTrue(is_a($event, '\MoxiworksPlatform\Event'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/update/fail.yml');
        $event = \MoxiworksPlatform\Event::update(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        \VCR\VCR::eject();
    }


    public function testCreateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('event/create/success.yml');
        $event = \MoxiworksPlatform\Event::create(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testCreateReturnsEventObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/create/success.yml');
        $event = \MoxiworksPlatform\Event::create(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        $this->assertTrue(is_a($event, '\MoxiworksPlatform\Event'));
        \VCR\VCR::eject();
    }

    public function testCreateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/create/fail.yml');
        $event = \MoxiworksPlatform\Event::create(['moxi_works_agent_id' => '1234abcd', 'partner_event_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('event/search/success.yml');
        $results = \MoxiworksPlatform\Event::search(['moxi_works_agent_id' => '1234abcd', 'date_start' => 1463595006, 'date_end' => 1463602226]);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('event/find/success.yml');
        $results = \MoxiworksPlatform\Event::search(['moxi_works_agent_id' => '1234abcd']);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateStartParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('event/find/success.yml');
        $results = \MoxiworksPlatform\Event::search(['moxi_works_agent_id' => '1234abcd', 'date_end' => 1463595006]);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateEndParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('event/find/success.yml');
        $results = \MoxiworksPlatform\Event::search(['moxi_works_agent_id' => '1234abcd', 'date_start' => 1463595006]);
        \VCR\VCR::eject();

    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('event/find/success.yml');
        $results = \MoxiworksPlatform\Event::search(['moxi_works_agent_id' => '1234abcd', 'date_start' => 1463595006, 'date_end' => 1463602226]);
        \VCR\VCR::eject();
    }


}