<?php


namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;


class Office extends Resource {

    /**
     * @var string the UUID of the office which the Office is associated
     */
    public $moxi_works_office_id;

    /**
     * @var string the id of the office
     */
    public $id;

    /**
    #
     * @var string a URL to an image of the office.
     */
    public $image_url;

    /**
     * @var string the name of the office
     */
    public $name;

    /**
     * @var string the office's address, street and number
     */
    public $address;

    /**
     * @var string address cont. (ex. suite number)
     */
    public $address2;

    /**
     * @var string the office's address, city
     */
    public $city;

    /**
     * @var string the office's address, county
     */
    public $county;

    /**
     * @var string the office's address, state
     */
    public $state;

    /**
     * @var string the office's address, zip code
     */
    public $zip_code;

    /**
     * @var string the office's alternate phone number
     */
    public $alt_phone;

    /**
     * @var string the office's email address
     */
    public $email;

    /**
     * @var string the office's facebook page URL
     */
    public $facebook;

    /**
     * @var string the office's google_plus  account
     */
    public $google_plus;

    /**
     * @var string the office's primary phone number
     */
    public $phone;

    /**
     * @var string the office's timezone
     */
    public $timezone;

    /**
     * @var string the office's twitter handle
     */
    public $twitter;

    /**
     * @var string URL of the office website
     */
    public $office_website;

    /**
     * @var string Common name of the office
     */
    public $common_name;

    /**
     * @var string region of the office
     */
    public $region;

    /**
     * Office constructor.
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
     * Find an Office on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works Office ID and Moxi Works Company ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Office::find([moxi_works_office_id: 'abc123', 'moxi_works_company_id' => 'foo_bar'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_office_id *REQUIRED* </b>The Moxi Works Office ID
     *       <br><b>moxi_works_company_id *REQUIRED* </b>The Moxi Works Company ID
     *
     *
     * @return Office|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $url = Config::getUrl() . "/api/offices/" . $attributes['moxi_works_office_id'];
        return Office::sendRequest('GET', $attributes, $url);
    }

    /**
     * Search for Offices by Company on Moxi Works Platform.
     *
     * search can be performed by including moxi_works_company_id in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Office::search([moxi_works_company_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_company_id *REQUIRED* </b> string The Moxi Works Company ID for the company in which we are searching for offices
     *
     *       <h2>
     *     optional Task search parameters
     * </h2>
     *
     * @return Array paged response array with the format:
     *   [
     *     page_number: [Integer],
     *     total_pages: [Integer],
     *     offices:  [Array] containing MoxiworkPlatform\Office objects
     *   ]
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/offices";
        $offices = array();

        $required_opts = array('moxi_works_company_id');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return null;

        foreach ($json['offices'] as $c) {
            $office = new Office($c);
            array_push($offices, $office);
        }
        $json['offices'] = $offices;
        return $json;
    }


    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Office|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/offices";
        }
        $required_opts = array('moxi_works_office_id', 'moxi_works_company_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");
        $office = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $office = (!isset($json) || empty($json)) ? null : new Office($json);
        return $office;
    }
}