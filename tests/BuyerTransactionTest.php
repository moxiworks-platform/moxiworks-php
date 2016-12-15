<?php

class BuyerTransactionTest extends PHPUnit_Framework_TestCase
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
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setSecret(null);
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('buyer_transaction/update/success.yml');
        $buyer_transaction = new \MoxiworksPlatform\BuyerTransaction(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $buyer_transaction->save();
        \VCR\VCR::eject();
    }

    public function testSaveReturnsBuyerTransactionObjectWhenSaveIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/update/success.yml');
        $buyer_transaction = new \MoxiworksPlatform\BuyerTransaction(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $response = $buyer_transaction->save();
        $this->assertTrue(is_a($response, '\MoxiworksPlatform\BuyerTransaction'));
        \VCR\VCR::eject();
    }

    public function testSaveThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/update/fail.yml');
        $buyer_transaction = new \MoxiworksPlatform\BuyerTransaction(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $response = $buyer_transaction->save();
        \VCR\VCR::eject();
    }


    public function testFindThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('buyer_transaction/find/success.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::find(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/find/nothing.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::find(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $this->assertNull($buyer_transaction);
        \VCR\VCR::eject();
    }

    public function testReturnsBuyerTransactionWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/find/success.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::find(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $this->assertTrue(is_a($buyer_transaction, '\MoxiworksPlatform\BuyerTransaction'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('buyer_transaction/update/success.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::update(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated BuyerTransaction2', 'description' => 'Updated BuyerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testUpdateReturnsBuyerTransactionObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/update/success.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::update(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated BuyerTransaction2', 'description' => 'Updated BuyerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $this->assertTrue(is_a($buyer_transaction, '\MoxiworksPlatform\BuyerTransaction'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/update/fail.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::update(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated BuyerTransaction2', 'description' => 'Updated BuyerTransaction', 'status' => 'completed']);
        \VCR\VCR::eject();
    }


    public function testCreateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('buyer_transaction/create/success.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::create(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated BuyerTransaction2', 'description' => 'Updated BuyerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testCreateReturnsBuyerTransactionObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/create/success.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::create(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated BuyerTransaction2', 'description' => 'Updated BuyerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $this->assertTrue(is_a($buyer_transaction, '\MoxiworksPlatform\BuyerTransaction'));
        \VCR\VCR::eject();
    }

    public function testCreateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/create/fail.yml');
        $buyer_transaction = \MoxiworksPlatform\BuyerTransaction::create(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated BuyerTransaction2', 'description' => 'Updated BuyerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('buyer_transaction/search/success.yml');
        $results = \MoxiworksPlatform\BuyerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006, 'due_date_end' => 1463602226]);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('buyer_transaction/find/success.yml');
        $results = \MoxiworksPlatform\BuyerTransaction::search(['moxi_works_agent_id' => '1234abcd']);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateStartParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('buyer_transaction/find/success.yml');
        $results = \MoxiworksPlatform\BuyerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_end' => 1463595006]);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateEndParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('buyer_transaction/find/success.yml');
        $results = \MoxiworksPlatform\BuyerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006]);
        \VCR\VCR::eject();

    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('buyer_transaction/find/success.yml');
        $results = \MoxiworksPlatform\BuyerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006, 'due_date_end' => 1463602226]);
        \VCR\VCR::eject();
    }


}