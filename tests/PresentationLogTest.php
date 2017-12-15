<?php

class PresentationLogTest extends PHPUnit_Framework_TestCase {
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


    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('presentation_log/search/success.yml');
        $results = \MoxiworksPlatform\PresentationLog::search([]);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoMoxiWorksCompanyIdParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('presentation_log/search/success.yml');
        $results = \MoxiworksPlatform\PresentationLog::search([ 'updated_after' => 1463595006]);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenNoUpdatedSinceParameterPassed() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('presentation_log/search/success.yml');
        $results = \MoxiworksPlatform\PresentationLog::search(['moxi_works_company_id' => '1234abcd']);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }



}