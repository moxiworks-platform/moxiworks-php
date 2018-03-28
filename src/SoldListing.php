<?php


namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;


class SoldListing extends Resource {
    /**
     * @var string the Moxi Works Platform ID of the SoldListing
     *   moxi_works_listing_id is the Moxi Works Platform ID of the SoldListing
     *
     *   this must be set for any Moxi Works Platform transaction
     *
     */
    public $moxi_works_listing_id;

    /**
     * @var float the property acreage of the SoldListing
     */
    public $lot_size_acres;

    /**
     * @var string the street address of the SoldListing
     */
    public $address;

    /**
     * @var string a second line for the street address if needed
     */
    public $address2;

    /**
     * @var boolean whether the agent created the SoldListing
     */
    public $agent_created_listing;

    /**
     * @var string the city of property address
     */
    public $city;

    /**
     * @var string the state of property address
     */
    public $state_or_province;

    /**
     * @var string zip code of property address
     */
    public $postal_code;

    /**
     * @var string county of property address
     */
    public $county_or_parish;

    /**
     * @var string latitude of address
     */
    public $latitude;

    /**
     * @var string longitude of address
     */
    public $longitude;

    /**
     * @var integer|null number of full bathrooms null if no data available
     */
    public $bathrooms_full;

    /**
     * @var integer|null number of half bathrooms null if no data available
     */
    public $bathrooms_half;

    /**
     * @var integer|null number of quarter bathrooms null if no data available
     */
    public $bathrooms_one_quarter;

    /**
     * @var integer|null number of partial bathrooms null if no data available
     */
    public $bathrooms_partial;

    /**
     * @var integer | null number of rooms that are bathrooms | nil if no data available
     */
    public $bathrooms_total_integer;

    /**
     * @var integer|null number of three_quarter bathrooms null if no data available
     */
    public $bathrooms_three_quarter;

    /**
     * @var float number of bathrooms
     */
    public $bathrooms_total;

    /**
     * @var integer number of bedrooms
     */
    public $bedrooms_total;

    /**
     * @var string agent generated comments regarding the property
     */
    public $public_remarks;

    /**
     * @var array date represented in format 'MM/DD/YYYY'
     */
    public $modification_timestamp;

    /**
     * @var boolean whether to display the address publicly
     */
    public $internet_address_display_yn;

    /**
     * @var integer number of days the SoldListing has been on market
     */
    public $days_on_market;

    /**
     * @var array date represented in format 'MM/DD/YYYY'
     */
    public $listing_contract_date;

    /**
     * @var array date represented in format 'MM/DD/YYYY'
     */
    public $created_date;

    /**
     * @var string elementary school for the property
     */
    public $elementary_school;

    /**
     * @var integer number of garage spaces
     */
    public $garage_spaces;

    /**
     * @var boolean|null whether the property has waterfront acreage
     */
    public $waterfront_yn;

    /**
     * @var string High school for the property
     */
    public $high_school;

    /**
     * @var integer HOA fees
     */
    public $association_fee;

    /**
     * @var string name of office responsible for SoldListing
     */
    public $list_office_name;

    /**
     * @var integer listed price
     */
    public $list_price;

    /**
     * @var string mls number for the SoldListing
     */
    public $listing_id;

    /**
     * @var string name of SoldListing agent
     */
    public $list_agent_full_name;

    /**
     * @var string moxi works agent id of SoldListing agent
     */
    public $list_agent_uuid;

    /**
     * @var integer square footage of lot
     */
    public $lot_size_square_feet;

    /**
     * @var string Middle school for the property
     */
    public $middle_or_junior_school;

    /**
     * @var string MLS the SoldListing is listed with
     */
    public $list_office_aor;

    /**
     * @var boolean whether to display the SoldListing on the internet
     */
    public $internet_entire_listing_display_yn;

    /**
     * @var boolean whether the SoldListing is on market
     */
    public $on_market;

    /**
     * @var boolean whether the property has a pool
     */
    public $pool_yn;

    /**
     * @var string type of property, could be 'Residential' 'Condo-Coop' 'Townhouse' 'Land' 'Multifamily'
     */
    public $property_type;

    /**
     * @var integer annual property tax for the property
     */
    public $tax_annual_amount;

    /**
     * @var integer assessment year that property_tax reflects
     */
    public $tax_year;

    /**
     * @var string moxi works agent id of secondary SoldListing agent
     */
    public $secondary_list_agent_uuid;

    /**
     * @var boolean whether the building is one story
     */
    public $single_story;

    /**
     * @var integer square footage of building
     */
    public $living_area;

    /**
     * @var boolean whether the property has a view
     */
    public $view_yn;

    /**
     * @var integer year the building was built
     */
    public $year_built;

    /**
     * @var string representing the date the listing was sold
     */
    public $sold_date;

    /**
     * @var integer price listing sold for
     */
    public $sold_price;

    /**
     * @var string Title of this listing
     */
    public $title;

    /**
     * @var array Company specific attributes associated with the listing.
     *  These will be defined by the company & should not be expected to be
     *   uniform across companies.
     */
    public $company_listing_attributes;




    /**
     * @var array of image arrays associated with the property in the format
     *
     * [
     *      "thumb_url" => "(string) url to thumbnail size image -- smallest",
     *      "small_url" => "(string) url to small size image -- small",
     *      "full_url" => "(string) url to medium size image -- medium",
     *      "gallery_url" => "(string) url to large size image -- large",
     *      "raw_url" => "(string) url to largest size image -- largest"
     *      "title" =>  (String) human readable title of image
     *      "is_main_listing_image" =>  (Boolean) whether the image is the main image for the SoldListing
     *      "caption" =>  (String) human readable caption for the image
     *      "description" =>  (String) human readable description of the image
     *      "width" =>  (Integer) width of the raw image
     *      "height" =>  (Integer) height of the raw image
     *      "mime_type" =>  (String) MIME or media type of the image
     * ]
     */
    public $listing_images;

    /**
     * @var array of associative arrays with the following format
     *
     * [
     *      "property_feature_name" => "(string) name of property feature"
     *      "property_feature_values" => "(array) values for property feature"
     * ]
     *
     */
    public $property_features;

    /**
     * @var array of associative arrays with the following format
     *
     * [
     *      "date" => "(string) string representing date of open house"
     *      "start_time" => "string representing start time of open house"
     *      "end_time" => "string representing end time of open house"
     * ]
     *
     */
    public $open_house;


    /**
     * SoldListing constructor.
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
     * Find a SoldListing on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works SoldListing ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\SoldListing::find([moxi_works_listing_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_listing_id *REQUIRED* </b>The Moxi Works SoldListing ID for the SoldListing
     *
     *
     * @return SoldListing|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $url = Config::getUrl() . "/api/sold_listings/" . $attributes['moxi_works_listing_id'];
        return SoldListing::sendRequest('GET', $attributes, $url);
    }

    /**
     * Search for SoldListings by Company on Moxi Works Platform.
     *
     * search can be performed by including moxi_works_company_id and sold_since in a parameter array
     *  <code>
     *  \MoxiworksPlatform\SoldListing::search([moxi_works_company_id: 'abc123', sold_since: 1463595006])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_company_id *REQUIRED* </b> string The Moxi Works Company ID for the company in which we are searching for SoldListings
     *
     *       <h2>
     *     optional Task search parameters
     * </h2>
     *       <br><b>sold_since </b> integer  Unix timestamp representing the start time for the search. If no <i>sold_since</i> parameter is included in the request, only SoldListings updated in the last seven days will be included in the response.
     *        <br><b>last_moxi_works_listing_id</b> string For multi-page responses (where the response value 'last_page' is false), send the SoldListing ID of the last SoldListing in the previous page.
     *
     * @return SoldListing paged response array with the format:
     *   [
     *     final_page: [Boolean],
     *     SoldListings:  [Array] containing MoxiworkPlatform\Listing objects
     *   ]
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/sold_listings";
        $listings = array();

        $required_opts = array('moxi_works_company_id');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return null;
        $json = SoldListing::underscoreAttributeNames($json);
        foreach ($json['listings'] as $c) {
            $listing = new SoldListing($c);
            array_push($listings, $listing);
        }
        $json['listings'] = $listings;
        return $json;
    }


    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return SoldListing|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/sold_listings";
        }
        $required_opts = array('moxi_works_listing_id', 'moxi_works_company_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");
        $listing = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $json = SoldListing::underscoreAttributeNames($json);
        $listing = (!isset($json) || empty($json)) ? null : new SoldListing($json);
        return $listing;
    }

    private static function underscoreAttributeNames($array) {
        $keys = array_keys($array);
        foreach($keys as $key) {
            if(is_array($array[$key])) {
                $array[$key] = SoldListing::underscoreAttributeNames($array[$key]);
            }
            if(is_string($key)) {
                $underscored = Resource::underscore($key);
                $array[$underscored] = $array[$key];
                unset($array[$key]);
            }
        }
        return $array;
    }

}