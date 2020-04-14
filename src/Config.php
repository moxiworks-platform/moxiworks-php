<?php


namespace MoxiworksPlatform;


class Config
{
    private static $url = "https://api.moxiworks.com";
    private static $debug = false;

    /**
     * The MoxiWorks Platform base URL. default is 'https://api.moxiworks.com'
     *
     * Modification of this attribute should not be needed unless you are debugging or developing for MoxiWorks Platform PHP SDK
     *
     * @param [String] the base url to use when connecting to The MoxiWorks Platform
     */
    public static function setUrl($u) {
        static::$url = trim($u);
    }

    /**
     * The MoxiWorks Platform base URL. default is 'https://api.moxiworks.com'
     *
     * @return String the base url to use when connecting to The MoxiWorks Platform
     */
    public static function getUrl() {
        return static::$url;
    }

    /**
     * Debug MoxiWorks Platform Requests. default is 'true'
     *
     * Modification of this attribute should not be needed unless you are debugging or developing for MoxiWorks Platform PHP SDK
     *
     * @param [Boolean] whether to print debug information for requests to MoxiWorks Platform
     */
    public static function setDebug($d) {
        static::$debug = (is_bool($d) && $d == true);
    }

    /**
     * Debug MoxiWorks Platform Requests. default is 'true'
     *
     * @return Boolean whether to print debug information for requests to MoxiWorks Platform
     */
    public static function getDebug() {
        return static::$debug;
    }

}