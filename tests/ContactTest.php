<?php

class ContactTest extends PHPUnit_Framework_TestCase {

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

    public function tearDown(){
        \MoxiworksPlatform\Credentials::setSecret(null);
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setInstance(null);
        parent::tearDown();
    }

    public function testSaveThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('contact/update/success.yml');
        $contact = new \MoxiworksPlatform\Contact(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $contact->save();
        \VCR\VCR::eject();
    }

    public function testSaveReturnsContactObjectWhenSaveIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/update/success.yml');
        $contact = new \MoxiworksPlatform\Contact(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $response = $contact->save();
        $this->assertTrue(is_a($response, '\MoxiworksPlatform\Contact'));
        \VCR\VCR::eject();
    }

    public function testSaveThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/update/fail.yml');
        $contact = new \MoxiworksPlatform\Contact(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $response = $contact->save();
        \VCR\VCR::eject();
    }

    public function testDeleteThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('contact/delete/success.yml');
        $contact = new \MoxiworksPlatform\Contact(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $contact->delete();
        \VCR\VCR::eject();
    }

    public function testDeleteReturnsContactObjectWhenDeleteIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/delete/success.yml');
        $contact = new \MoxiworksPlatform\Contact(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $response = $contact->delete();
        $this->assertTrue(is_a($response, '\MoxiworksPlatform\Contact'));
        \VCR\VCR::eject();
    }

    public function testDeleteThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/delete/fail.yml');
        $contact = new \MoxiworksPlatform\Contact(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $response = $contact->delete();
        \VCR\VCR::eject();
    }

    public function testFindThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('contact/find/success.yml');
        $contact = \MoxiworksPlatform\Contact::find(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
            \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/find/nothing.yml');
        $contact = \MoxiworksPlatform\Contact::find(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertNull($contact);
        \VCR\VCR::eject();
    }

    public function testReturnsContactWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/find/success.yml');
        $contact = \MoxiworksPlatform\Contact::find(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_a($contact, '\MoxiworksPlatform\Contact'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('contact/update/success.yml');
        $contact = \MoxiworksPlatform\Contact::update(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testUpdateReturnsContactObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/update/success.yml');
        $contact = \MoxiworksPlatform\Contact::update(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_a($contact, '\MoxiworksPlatform\Contact'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/update/fail.yml');
        $contact = \MoxiworksPlatform\Contact::update(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }


    public function testCreateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('contact/create/success.yml');
        $contact = \MoxiworksPlatform\Contact::create(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testCreateReturnsContactObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/create/success.yml');
        $contact = \MoxiworksPlatform\Contact::create(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        $this->assertTrue(is_a($contact, '\MoxiworksPlatform\Contact'));
        \VCR\VCR::eject();
    }

    public function testCreateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/create/fail.yml');
        $contact = \MoxiworksPlatform\Contact::create(['moxi_works_agent_id' => '1234abcd', 'partner_contact_id' => 'booyuh']);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/search/success.yml');
        $results = \MoxiworksPlatform\Contact::search(['moxi_works_agent_id' => '1234abcd', 'contact_name' => 'buckminster fuller']);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public function testSearchReturnsEmptyArrayWhenRequestFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/search/empty.yml');
        $results = \MoxiworksPlatform\Contact::search(['moxi_works_agent_id' => '1234abcd', 'contact_name' => 'buckminster fuller']);
        $this->assertTrue(is_array($results));
        $this->assertEmpty($results);
        \VCR\VCR::eject();
    }

    public function returnsContactObjectsInArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('contact/search/empty.yml');
        $results = \MoxiworksPlatform\Contact::search(['moxi_works_agent_id' => '1234abcd', 'contact_name' => 'buckminster fuller']);
        foreach ($results as $result) {
            $this->assertTrue(is_a($result, '\MoxiworksPlatform\Contact'));
        }
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('contact/find/success.yml');
        $contact = \MoxiworksPlatform\Contact::search(['moxi_works_agent_id' => '1234abcd']);
        \VCR\VCR::eject();

    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('contact/find/success.yml');
        $contact = \MoxiworksPlatform\Contact::search(['moxi_works_agent_id' => '1234abcd', 'contact_name' => 'buckminster fuller']);
        \VCR\VCR::eject();
    }

}
