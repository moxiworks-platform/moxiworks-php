<?php

class SellerTransactionTest extends PHPUnit_Framework_TestCase
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
        \VCR\VCR::insertCassette('seller_transaction/update/success.yml');
        $seller_transaction = new \MoxiworksPlatform\SellerTransaction(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $seller_transaction->save();
        \VCR\VCR::eject();
    }

    public function testSaveReturnsSellerTransactionObjectWhenSaveIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/update/success.yml');
        $seller_transaction = new \MoxiworksPlatform\SellerTransaction(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $response = $seller_transaction->save();
        $this->assertTrue(is_a($response, '\MoxiworksPlatform\SellerTransaction'));
        \VCR\VCR::eject();
    }

    public function testSaveThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/update/fail.yml');
        $seller_transaction = new \MoxiworksPlatform\SellerTransaction(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $response = $seller_transaction->save();
        \VCR\VCR::eject();
    }


    public function testFindThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('seller_transaction/find/success.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::find(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/find/nothing.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::find(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $this->assertNull($seller_transaction);
        \VCR\VCR::eject();
    }

    public function testReturnsSellerTransactionWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/find/success.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::find(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface']);
        $this->assertTrue(is_a($seller_transaction, '\MoxiworksPlatform\SellerTransaction'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('seller_transaction/update/success.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::update(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated SellerTransaction2', 'description' => 'Updated SellerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testUpdateReturnsSellerTransactionObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/update/success.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::update(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated SellerTransaction2', 'description' => 'Updated SellerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $this->assertTrue(is_a($seller_transaction, '\MoxiworksPlatform\SellerTransaction'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/update/fail.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::update(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated SellerTransaction2', 'description' => 'Updated SellerTransaction', 'status' => 'completed']);
        \VCR\VCR::eject();
    }


    public function testCreateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('seller_transaction/create/success.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::create(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated SellerTransaction2', 'description' => 'Updated SellerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testCreateReturnsSellerTransactionObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/create/success.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::create(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated SellerTransaction2', 'description' => 'Updated SellerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $this->assertTrue(is_a($seller_transaction, '\MoxiworksPlatform\SellerTransaction'));
        \VCR\VCR::eject();
    }

    public function testCreateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/create/fail.yml');
        $seller_transaction = \MoxiworksPlatform\SellerTransaction::create(['moxi_works_agent_id' => '1234abcd', 'moxi_works_transaction_id' => 'feedface-dead-beef-bad4-dad2feedface', 'partner_contact_id' => 'booyuh', 'name' => 'Updated SellerTransaction2', 'description' => 'Updated SellerTransaction', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('seller_transaction/search/success.yml');
        $results = \MoxiworksPlatform\SellerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006, 'due_date_end' => 1463602226]);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('seller_transaction/find/success.yml');
        $results = \MoxiworksPlatform\SellerTransaction::search(['moxi_works_agent_id' => '1234abcd']);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateStartParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('seller_transaction/find/success.yml');
        $results = \MoxiworksPlatform\SellerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_end' => 1463595006]);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateEndParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('seller_transaction/find/success.yml');
        $results = \MoxiworksPlatform\SellerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006]);
        \VCR\VCR::eject();

    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('seller_transaction/find/success.yml');
        $results = \MoxiworksPlatform\SellerTransaction::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006, 'due_date_end' => 1463602226]);
        \VCR\VCR::eject();
    }


}