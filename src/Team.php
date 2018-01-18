<?php


namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;


class Team extends Resource {

    /**
     * @var string The unique ID of the Team
     */
    public $uuid;


    /**
     * @var string The human readable name of the team
     */
    public $name;


    /**
     * @var string Contact email address for the team
     */
    public $email;


    /**
     * @var string First line of contact address for the team
     */
    public $address1;


    /**
     * @var string Second line of contact address for the team
     */
    public $address2;


    /**
     * @var string City portion of contact address for the team
     */
    public $city;


    /**
     * @var string State portion of contact address for the team
     */
    public $state;


    /**
     * @var string Postal Code portion of the contact address for the team
     */
    public $zipcode;


    /**
     * @var string contact phone number for the team
     */
    public $phone;


    /**
     * @var string fax number for the team
     */
    public $fax;


    /**
     * @var string URL to a logo image for the team
     */
    public $logo_url;


    /**
     * @var string First URL to a image  representing the team
     */
    public $photo_url;


    /**
     * @var string Description of the team. can contain embedded HTML
     */
    public $description;


    /**
     * @var array Social media URLs associated with the team
     */
    public $social_media_urls;


    /**
     * @var string Alternate contact phone number for the team
     */
    public $alt_phone;


    /**
     * @var string Alternate contact email address for the team
     */
    public $alt_email;


    /**
     * @var string URL to the website for the team
     */
    public $website_url;


    /**
     * @var boolean Whether the team is active or not
     */
    public $active;

    /**
     * Team constructor.
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
     * Find an Team on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works Team ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Team::find([moxi_works_team_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_team_id *REQUIRED* </b>The Moxi Works Team ID for the team
     *
     *
     * @return Team|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $url = Config::getUrl() . "/api/teams/" . $attributes['moxi_works_team_id'];
        return Team::sendRequest('GET', $attributes, $url);
    }

    /**
     * Search for Teams by Company on Moxi Works Platform.
     *
     * search can be performed by including moxi_works_company_id and updated_since in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Team::search([moxi_works_company_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_company_id *REQUIRED* </b> string The Moxi Works Company ID for the company in which we are searching for teams
     *
     *       <h2>
     *     optional Task search parameters
     * </h2>
     *
     * @return Array array of Team objects:
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/teams";
        $results = array();

        $required_opts = array('moxi_works_company_id');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return $results;

        foreach($json as $element) {
            $team = new Team($element);
            array_push($results, $team);
        }
        return $results;
    }


    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Team|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/teams";
        }
        $required_opts = array('moxi_works_team_id', 'moxi_works_company_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");
        $team = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $team = (!isset($json) || empty($json)) ? null : new Team($json);
        return $team;
    }



}