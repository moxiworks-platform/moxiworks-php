<?php

class EmailCampaignTest extends PHPUnit_Framework_TestCase
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
    

    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('email_campaign/search/success.yml');
        $results = \MoxiworksPlatform\EmailCampaign::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public function testSearchReturnsEmailCampaignsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('email_campaign/search/success.yml');
        $results = \MoxiworksPlatform\EmailCampaign::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public function testSearchEmailCampaignsArrayIsPopulatedWithEmailCampaignObjectsWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('email_campaign/search/success.yml');
        $results = \MoxiworksPlatform\EmailCampaign::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_a($results[0], '\MoxiworksPlatform\EmailCampaign'));

        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('email_campaign/search/success.yml');
        $results = \MoxiworksPlatform\EmailCampaign::search(['moxi_works_agent_id' => '1234abcd']);
        \VCR\VCR::eject();
    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('email_campaign/search/success.yml');
        $results = \MoxiworksPlatform\EmailCampaign::search(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }


}