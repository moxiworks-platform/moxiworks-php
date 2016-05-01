<?php


namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;


class Agent extends Resource {
    /**
     * @var string the Moxi Works Platform ID of the agent
     *   moxi_works_agent_id is the Moxi Works Platform ID of the agent which a contact is
     *   or is to be associated with.
     *
     *   this must be set for any Moxi Works Platform transaction
     *
     */
    public $moxi_works_agent_id;

    /**
     *
     * @var array a group of strings representing any mls the agent 
     *      is a member of
     */
    public $mls;
    
    /**
     * 
     * @var string any accreditation the agent has
     */
    public $accreditation;

    /**
     * @var string the agent's address, street and number
     */
    public $address_street;

    /**
     * @var string the agent's address, city
     */
    public $address_city;

    /**
     * @var string the agent's address, state
     */
    public $address_state;

    /**
     * @var string the agent's address, zip code
     */
    public $address_zip;

    /**
     * @var string the agent's office address, street and number
     */
    public $office_address_street;

    /**
     * @var string the agent's office address, city
     */
    public $office_address_city;

    /**
     * @var string the agent's office address, state
     */
    public $office_address_state;

    /**
     * @var string the agent's office address, zip code
     */
    public $office_address_zip;

    /**
     * @var string the agent's name
     */
    public $name;

    /**
     * @var string agent's license number
     */
    public $license;

    /**
     * @var string agent's mobile phone number
     */
    public $mobile_phone_number;

    /**
     * @var string agent's home phone number
     */
    public $home_phone_number;

    /**
     * @var string agent's fax phone number
     */
    public $fax_phone_number;

    /**
     * @var string agent's main phone number
     */
    public $main_phone_number;

    /**
     * @var string agent's office phone number
     */
    public $office_phone_number;

    /**
     * @var string agent's primary email address
     */
    public $primary_email_address;

    /**
     * @var string agent's secondary email address
     */
    public $secondary_email_address;

    /**
     * @var array any languages the agent speaks
     */
    public $languages;

    /**
     * @var string agent's twitter handel
     */
    public $twitter;

    /**
     * @var string agent's google plus page url
     */
    public $google_plus;

    /**
     * @var string agent's facebook page url
     */
    public $facebook;

    /**
     * @var string agent's home page url
     */
    public $home_page;

    /**
     * @var string agent's date of birth
     */
    public $birth_date;

    /**
     * @var string agent's title
     */
    public $title;

    /**
     * @var string url of a full sized profile image of the agent
     */
    public $profile_image_url;

    /**
     * @var string url of a thumb sized profile image of the agent
     */
    public $profile_thumb_url;

    /**
     * Agent constructor.
     * @param array $data
     */
    function __construct(array $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Find an Agent on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works Agent ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Contact::find([moxi_works_agent_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent
     *
     *
     * @return Agent|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $url = Config::getUrl() . "/api/agents/" . $attributes['moxi_works_agent_id'];
        return Agent::sendRequest('GET', $attributes, $url);
    }

    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Agent|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/agents";
        }
        $required_opts = array('moxi_works_agent_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");
        $agent = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $agent = (!isset($json) || empty($json)) ? null : new Agent($json);
        return $agent;
    }
}