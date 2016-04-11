<?php


class ResourceTest extends PHPUnit_Framework_TestCase {
    public $identifier = 'fizz';
    public $secret = 'bazzle';

    public function setUp() {
        $a = new \MoxiworksPlatform\Credentials($this->identifier, $this->secret);
        parent::setUp();
    }

    public function tearDown() {
        \MoxiworksPlatform\Credentials::setInstance(null);
        parent::tearDown();
    }

    public function testThrowsExceptionWhenCredentialsNotSet() {
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setSecret(null);
        \MoxiworksPlatform\Credentials::setInstance(null);

        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \MoxiworksPlatform\Resource::headers();
    }

    public function testHeadersReturnsArray() {
        $this->assertTrue(is_array(\MoxiworksPlatform\Resource::headers()));
    }

    public function testHeadersContainsAuthorizationHeader() {
        $this->assertTrue(array_key_exists('Authorization', \MoxiworksPlatform\Resource::headers()));
    }

    public function testHeadersContainsAcceptHeader() {
        $this->assertTrue(array_key_exists('Accept', \MoxiworksPlatform\Resource::headers()));
    }

    public function testHeadersContainsContentTypeHeader() {
        $this->assertTrue(array_key_exists('Content-Type', \MoxiworksPlatform\Resource::headers()));
    }

    public function testAuthHeaderThrowsExceptionWhenAuthNotSet() {
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setSecret(null);
        \MoxiworksPlatform\Credentials::setInstance(null);

        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \MoxiworksPlatform\Resource::authHeader();
    }

    public function testAuthHeaderIsString() {
        $this->assertTrue(is_string(MoxiworksPlatform\Resource::authHeader()));
    }

    public function testAuthHeaderIsNotEmptyString() {
        $this->assertFalse(empty(MoxiworksPlatform\Resource::authHeader()));
    }

    public function testAuthHeaderHasBasicAsFirstWord() {
        $this->assertRegExp('/^Basic/', MoxiworksPlatform\Resource::authHeader());
    }

    public function testAuthHeaderIsBase64EncodedFormat() {
        $this->assertRegExp('/^Basic\ ([A-Za-z0-9+]{4})*([A-Za-z0-9+]{4}|[A-Za-z0-9+]{3}=|[A-Za-z0-9+]{2}==)$/', MoxiworksPlatform\Resource::authHeader());
    }

    public function testAuthHeaderBase64Encoding() {
        $payload = end(explode(' ', MoxiworksPlatform\Resource::authHeader()));
        $this->assertEquals(base64_decode($payload), "$this->identifier:$this->secret");
    }

    public function testAcceptHeaderIsInExpectedFormat() {
        $this->assertRegExp('/application\/vnd.moxi-platform\+json;version=?/', MoxiworksPlatform\Resource::acceptHeader());
    }

    public function testContentTypeHeaderIsInExpectedFormat() {
        $this->assertEquals('application/x-www-form-urlencoded', MoxiworksPlatform\Resource::contentTypeHeader());
    }

    public function testCheckForErrorInResponseThrowsExceptionForBadJSON() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        MoxiworksPlatform\Resource::checkForErrorInResponse('not json');
    }

    public function testDoNothingIfNoStatusInResponse() {
        $this->assertTrue(MoxiworksPlatform\Resource::checkForErrorInResponse(['this' => 'that']));
    }

    public function testDoesNothingIfStatusIsNotFailOrError() {
        $this->assertTrue(MoxiworksPlatform\Resource::checkForErrorInResponse(['status' => 'that']));
    }

    public function testThrowsExceptionIfStatusIsFail() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $this->assertTrue(MoxiworksPlatform\Resource::checkForErrorInResponse(['status' => 'fail']));
    }

    public function testThrowsExceptionIfStatusIsError() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $this->assertTrue(MoxiworksPlatform\Resource::checkForErrorInResponse(['status' => 'error']));
    }
}
