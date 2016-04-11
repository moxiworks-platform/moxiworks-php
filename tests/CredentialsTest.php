<?php


class CredentialsTest extends PHPUnit_Framework_TestCase {
    public function testOnlyInstantiatesOneInstance() {
        $a = new \MoxiworksPlatform\Credentials('whatevers', '2009');
        $b = new \MoxiworksPlatform\Credentials('dubya', 'worst');
        $this->assertEquals($a, $b);
    }

    public function testPopulatesInstanceAttributeWithSingletonInstnace() {
        $a = new \MoxiworksPlatform\Credentials('whatevers', '2009');
        $this->assertEquals(\MoxiworksPlatform\Credentials::instance(), $a);
    }

    public function testPopulatesStaticIdentifierAttributeWithInstantiatedValue() {
        $identifier = 'whatevers';
        $secret = '2009';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::identifier(), $identifier);
    }

    public function testPopulatesStaticSecretAttributeWithInstantiatedValue() {
        $identifier = 'whatevers';
        $secret = '2009';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::secret(), $secret);
    }

    public function testHasSameDataInInstanceAndStaticIdentifierAttribute() {
        $identifier = 'fooballs';
        $secret = 'cantsee';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::identifier(), $a->getIdentifier());
    }

    public function testHasSameDataInInstanceAndStaticSecretAttribute() {
        $identifier = 'fooballs';
        $secret = 'cantsee';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::secret(), $a->getSecret());
    }

    public function testIsReadyWhenIdentifierAndSecretAreSet() {
        $identifier = 'fooballs';
        $secret = 'cantsee';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertTrue(\MoxiworksPlatform\Credentials::ready());
    }

    public function testIsNotReadyWhenIdentifierNullAndSecretSet() {
        $identifier = null;
        $secret = 'cantsee';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertFalse(\MoxiworksPlatform\Credentials::ready());
    }

    public function testIsNotReadyWhenIdentifierSetAndSecretNull() {
        $identifier = 'fooball';
        $secret = null;
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertFalse(\MoxiworksPlatform\Credentials::ready());
    }

    public function testIsNotReadyWhenIdentifierNullAndSecretNull() {
        $identifier = null;
        $secret = null;
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertFalse(\MoxiworksPlatform\Credentials::ready());
    }

    public function testAccessToPlatformIdentifierViaInstanceMethod() {
        $identifier = 'foodiddle';
        $secret = 'widdyfazz';
        $updated_id = 'bazdiddle';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::identifier(), $identifier);
        $a->setIdentifier($updated_id);
        $this->assertEquals(\MoxiworksPlatform\Credentials::identifier(), $updated_id);
    }

    public function testAccessToPlatformSecretViaInstanceMethod() {
        $identifier = 'foodiddle';
        $secret = 'widdyfazz';
        $updated_secret = 'bazdiddle';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::secret(), $secret);
        $a->setSecret($updated_secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::secret(), $updated_secret);
    }

    public function testAccessToIdentifierViaClassMethod() {
        $identifier = 'roozyfizz';
        $secret = 'cladyfaadd';
        $updated_id = 'wizzerdidd';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::identifier(), $identifier);
        MoxiworksPlatform\Credentials::setIdentifier($updated_id);
        $this->assertEquals(\MoxiworksPlatform\Credentials::identifier(), $updated_id);
    }

    public function testAccessToPlatformSecretViaClassMethod() {
        $identifier = 'zizzerfazz';
        $secret = 'targerara';
        $updated_secret = 'laaddrfaddle';
        $a = new \MoxiworksPlatform\Credentials($identifier, $secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::secret(), $secret);
        MoxiworksPlatform\Credentials::setSecret($updated_secret);
        $this->assertEquals(\MoxiworksPlatform\Credentials::secret(), $updated_secret);
    }


}
