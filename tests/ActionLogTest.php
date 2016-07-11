<?php

class ActionLogTest extends PHPUnit_Framework_TestCase
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
    
    public function testCreateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('action_log/create/success.yml');
        $action_log = \MoxiworksPlatform\ActionLog::create(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testCreateReturnsActionLogObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('action_log/create/success.yml');
        $action_log = \MoxiworksPlatform\ActionLog::create(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_a($action_log, '\MoxiworksPlatform\ActionLog'));
        \VCR\VCR::eject();
    }

    public function testCreateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('action_log/create/fail.yml');
        $action_log = \MoxiworksPlatform\ActionLog::create(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('action_log/search/success.yml');
        $results = \MoxiworksPlatform\ActionLog::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public function testSearchReturnsActionsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('action_log/search/success.yml');
        $results = \MoxiworksPlatform\ActionLog::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_array($results['actions']));
        \VCR\VCR::eject();
    }

    public function testSearchActionsArrayIsPopulatedWithActionLogObjectsWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('action_log/search/success.yml');
        $results = \MoxiworksPlatform\ActionLog::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_a($results['actions'][0], '\MoxiworksPlatform\ActionLog'));

        \VCR\VCR::eject();
    }
    
    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('action_log/search/success.yml');
        $results = \MoxiworksPlatform\ActionLog::search(['moxi_works_agent_id' => '1234abcd']);
        \VCR\VCR::eject();
    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('action_log/search/success.yml');
        $results = \MoxiworksPlatform\ActionLog::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }


}