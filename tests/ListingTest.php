<?php

class ListingTest extends PHPUnit_Framework_TestCase {
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
        \VCR\VCR::insertCassette('listing/find/success.yml');
        $listing = \MoxiworksPlatform\Listing::find(['moxi_works_listing_id' => 'abc123', 'moxi_works_company_id' => 'abc123']);
        \VCR\VCR::eject();
    }

    public  function testeFindthrowsExceptionWhenNoCompanyParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('listing/find/success.yml');
        $listing = \MoxiworksPlatform\Listing::find(['moxi_works_listing_id' => 'abc123']);
        \VCR\VCR::eject();

    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('listing/find/nothing.yml');
        $listing = \MoxiworksPlatform\Listing::find(['moxi_works_listing_id' => 'abc123', 'moxi_works_company_id' => 'abc123']);
        $this->assertNull($listing);
        \VCR\VCR::eject();
    }

    public function testReturnsListingWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('listing/find/success.yml');
        $listing = \MoxiworksPlatform\Listing::find(['moxi_works_listing_id' => 'abc123', 'moxi_works_company_id' => 'abc123']);
        $this->assertTrue(is_a($listing, '\MoxiworksPlatform\Listing'));
        \VCR\VCR::eject();
    }


    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('listing/search/success.yml');
        $results = \MoxiworksPlatform\Listing::search(['moxi_works_company_id' => '1234abcd', 'updated_since' => 1463595006]);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public  function testSearchThrowsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('listing/find/success.yml');
        $results = \MoxiworksPlatform\Listing::search([]);
        \VCR\VCR::eject();
    }

    public  function testSearchThrowsExceptionWhenNoMoxiWorksCompanyIdParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('listing/find/success.yml');
        $results = \MoxiworksPlatform\Listing::search([ 'updated_since' => 1463595006]);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenNoUpdatedSinceParameterPassed() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('listing/search/success.yml');
        $results = \MoxiworksPlatform\Listing::search(['moxi_works_company_id' => '1234abcd']);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }



}