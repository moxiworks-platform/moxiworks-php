<?php

class CompanyTest extends PHPUnit_Framework_TestCase {
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
        \VCR\VCR::insertCassette('company/find/success.yml');
        $company = \MoxiworksPlatform\Company::find(['moxi_works_company_id' => 'helgas_better_houses']);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('company/find/nothing.yml');
        $company = \MoxiworksPlatform\Company::find(['moxi_works_company_id' => 'helgas_better_houses']);
        $this->assertNull($company);
        \VCR\VCR::eject();
    }

    public function testReturnsCompanyWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('company/find/success.yml');
        $company = \MoxiworksPlatform\Company::find(['moxi_works_company_id' => 'helgas_better_houses']);
        $this->assertTrue(is_a($company, '\MoxiworksPlatform\Company'));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('company/find/success.yml');
        $company = \MoxiworksPlatform\Company::find();
        \VCR\VCR::eject();
    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setSecret(null);
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('company/search/success.yml');
        $company = \MoxiworksPlatform\Company::search();
        \VCR\VCR::eject();
    }

    public function testSearchReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('company/search/nothing.yml');
        $company = \MoxiworksPlatform\Company::search();
        $this->assertTrue(empty($company));
        \VCR\VCR::eject();
    }

    public function testSearchReturnsCompanysWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('company/search/success.yml');
        $company = \MoxiworksPlatform\Company::search();
        $this->assertTrue(is_array($company));
        \VCR\VCR::eject();
    }


}