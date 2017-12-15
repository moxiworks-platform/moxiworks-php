<?php


namespace MoxiworksPlatform;
use Symfony\Component\Translation\Tests\StringClass;

/** Object used to manage Moxi Works Platform credentials
 *
 */
class Credentials
{
    /**
     * @var StringClass Your Moxi Works Platform Identifier.
     *
     *  this must be set before any Moxi Works Platform calls can be made.
     */
    private static $identifier;

    /**
     * @var StringClass Your Moxi Works Platform secret.
     *
     *   this must be set before any Moxi Works Platform calls can be made
     */
    private static $secret;

    /**
     * @var \MoxiworksPlatform\Credentials The Singleton instance of this class.
     */
    private static $instance;


    /**
     * Constructs a new MoxiworksPlatform\Credentials object, with the specified
     * Moxi Works Platform Identifier and Moxi Works Platform Secret
     *
     * @param StringClass $platform_id   Your Moxi Works Platform ID
     * @param StringClass $secret  Your Moxi Works Platform Secret
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
     * @param $sec StringClass Your Moxi Works Platform secret
     */
    public static function setSecret($sec) {
        Credentials::$secret = $sec;
    }

    /**
     * @return StringClass Your Moxi Works Platform Identifier
     */
    public static function identifier() {
        return Credentials::$identifier;
    }

    /**
     * @param $pid StringClass Your Moxi Works Platform ID
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
     * @return bool Whether the Moxi Works Platform Identifier and Secret have been set.
     */
    public static function ready() {
        return (null !== Credentials::getIdentifier() && null !== Credentials::getSecret());
    }


    /**
     * Returns the Moxi Works Platform Identifier for this credentials object.
     *
     * @return string
     */
    public static function getIdentifier() {
        return Credentials::$identifier;
    }

    /**
     * Returns the Moxi Works Platform secret for this credentials object.
     *
     * @return string
     */
    public static function getSecret() {
        return Credentials::$secret;
    }


}