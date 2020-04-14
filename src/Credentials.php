<?php


namespace MoxiworksPlatform;
use Symfony\Component\Translation\Tests\StringClass;

/** Object used to manage MoxiWorks Platform credentials
 *
 */
class Credentials
{
    /**
     * @var StringClass Your MoxiWorks Platform Identifier.
     *
     *  this must be set before any MoxiWorks Platform calls can be made.
     */
    private static $identifier;

    /**
     * @var StringClass Your MoxiWorks Platform secret.
     *
     *   this must be set before any MoxiWorks Platform calls can be made
     */
    private static $secret;

    /**
     * @var \MoxiworksPlatform\Credentials The Singleton instance of this class.
     */
    private static $instance;


    /**
     * Constructs a new MoxiworksPlatform\Credentials object, with the specified
     * MoxiWorks Platform Identifier and MoxiWorks Platform Secret
     *
     * @param StringClass $platform_id   Your MoxiWorks Platform ID
     * @param StringClass $secret  Your MoxiWorks Platform Secret
     */
    public function __construct($platform_id, $secret){
        Credentials::setIdentifier($platform_id);
        Credentials::setSecret($secret);
        if(Credentials::instance())
            return;
        Credentials::setInstance($this);
    }

    /**
     *  The configured platform secret
     *
     * @return StringClass the platform secret
     */
    public static function secret() {
        return Credentials::$secret;
    }

    /**
     * @param $sec StringClass Your MoxiWorks Platform secret
     */
    public static function setSecret($sec) {
        Credentials::$secret = $sec;
    }

    /**
     * @return StringClass Your MoxiWorks Platform Identifier
     */
    public static function identifier() {
        return Credentials::$identifier;
    }

    /**
     * @param $pid StringClass Your MoxiWorks Platform ID
     */
    public static function setIdentifier($pid) {
        Credentials::$identifier = $pid;
    }

    /**
     * @return Credentials The  Singleton instance of this class.
     */
    public static function instance() {
        return Credentials::$instance;
    }

    /**
     * @param $inst Credentials The Singleton instnace of this class
     */
    public static function setInstance($inst) {
        Credentials::$instance = $inst;
    }

    /**
     * @return bool Whether the MoxiWorks Platform Identifier and Secret have been set.
     */
    public static function ready() {
        return (null !== Credentials::getIdentifier() && null !== Credentials::getSecret());
    }


    /**
     * Returns the MoxiWorks Platform Identifier for this credentials object.
     *
     * @return string
     */
    public static function getIdentifier() {
        return Credentials::$identifier;
    }

    /**
     * Returns the MoxiWorks Platform secret for this credentials object.
     *
     * @return string
     */
    public static function getSecret() {
        return Credentials::$secret;
    }


}