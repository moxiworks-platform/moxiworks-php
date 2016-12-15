<?php

class OfficeTest extends PHPUnit_Framework_TestCase {
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
        \VCR\VCR::insertCassette('office/find/success.yml');
        $office = \MoxiworksPlatform\Office::find(['moxi_works_company_id' => 'brokeroker', 'moxi_works_office_id' => 'feedface-dead-beef-bad4-dad2feedface' ]);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('office/find/nothing.yml');
        $office = \MoxiworksPlatform\Office::find(['moxi_works_company_id' => 'brokeroker', 'moxi_works_office_id' => 'feedface-dead-beef-bad4-dad2feedface' ]);
        $this->assertNull($office);
        \VCR\VCR::eject();
    }

    public function testReturnsOfficeWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('office/find/success.yml');
        $office = \MoxiworksPlatform\Office::find(['moxi_works_company_id' => 'brokeroker', 'moxi_works_office_id' => 'feedface-dead-beef-bad4-dad2feedface' ]);
        $this->assertTrue(is_a($office, '\MoxiworksPlatform\Office'));
        \VCR\VCR::eject();
    }


    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('office/search/success.yml');
        $results = \MoxiworksPlatform\Office::search(['moxi_works_company_id' => 'brokeroker']);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('office/find/success.yml');
        $results = \MoxiworksPlatform\Office::search([]);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoMoxiWorksCompanyIdParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('office/find/success.yml');
        $results = \MoxiworksPlatform\Office::search([ 'moxi_works_office_id' => 'feedface-dead-beef-bad4-dad2feedface' ]);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoMoxiWorksOfficeIdParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('office/find/success.yml');
        $results = \MoxiworksPlatform\Office::search([ 'moxi_works_company_id' => 'brokeroker' ]);
        \VCR\VCR::eject();
    }



}