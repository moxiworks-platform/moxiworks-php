<?php


namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;


class Contact extends Resource {

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
    * @var string your system's unique ID for the contact
    *   *your system's* unique ID for the Contact
    *
    *   this must be set for any Moxi Works Platform transaction
    *
     */
    public $partner_contact_id;


    /**
    * @var string -- Default ''
    *   the full name of this Contact
    *
     */
    public $contact_name;

    /**
    * @var string, Enumerated -- a single character 'm' or 'f' or -- Default ''
    *   the gender  of this Contact. the first initial of either gender type may
    *   be used or the full word 'male' or 'female.'
    *   <p>
    *   <b>note: The single character representation will be used after saving to Moxi Works Platform  no matter whether the word or single character representation is passed in.</b>
    *
     */
    public $gender;

    /**
    * @var string -- Default ''
    *   the street address of the residence of this Contact
    *
     */
    public $home_street_address;

    /**
    * @var string -- Default ''
    *   the city of the residence of this Contact
    *
     */
    public $home_city;

    /**
    * @var string -- Default ''
    *   the state in which the residence of this Contact is located
    *
    *   this can either be the state's abbreviation or the full name of the state
    *
     */
    public $home_state;

    /**
    * @var string -- Default ''
    *   the zip code of the residence of this Contact
    *
     */
    public $home_zip;

    /**
    * @var string -- Default ''
    *   the neighborhood of the residence of this Contact
    *
    *   
     */
    public $home_neighborhood;

    /**
    * @var string -- Default ''
    *   the country of the residence of this Contact
    *
    *   this can either be the country's abbreviation or the full name of the country
    *
    *   
     */
    public $home_country;

    /**
    * @var string -- Default ''
    *   the specific job title this contact has; ex: 'Senior VP of Operations'
    *
    *   
     */
    public $job_title;

    /**
     * @var string -- Default ''
     *   human readable notes associated with the contact; ex: 'very interested in Springfield Heights'
     *
     *
     */
    public $note;

    /**
     * @var string -- Default ''
     *   the general occupation of this contact; ex: 'Software Developer'
     *
     *
     */
    public $occupation;


    /**
     * @var boolean
     *   Whether the contact was recently added to the Agent's database.
     *
     *
     */
    public $is_new_contact;

    /**
     * @var integer
     *   Birthday of the contact represented as a Unix Timestamp.
     *
     *
     */
    public $birthday;

    /**
     * @var integer
     *   Wedding anniversary of the contact represented as a Unix Timestamp.
     *
     *
     */
    public $anniversary;

    /**
     * @var home_purchase_anniversary
     *   Anniversary of the contact's home purchase represented as a Unix Timestamp.
     *
     *
     */
    public $home_purchase_anniversary;


    /**
     * @var array
     *   URLs to any social media profiles that the agent has defined.
     *
     * The structure of each social media profile entry will be an associative array with
     * the following format:
     *  { "key" => "KEY_VAL_AS_STRING", "url" => "URL_OF_SOCIAL_MEDIA_PROFILE" }
     *
     *
     */
    public $social_media_profiles;


    /**
    * @var string -- Default ''
    *   your system's unique identifier for the agent that this contact will be associated with
    *
    *   
     */
    public $partner_agent_id;

    /**
    * @var string -- Default ''
    *   the email address the contact would want to be contacted via first
    *
    *   
     */
    public $primary_email_address;

    /**
    * @var string -- Default ''
    *   the phone number the contact would want to be contacted via first
    *
    *   
     */
    public $primary_phone_number;

    /**
    * @var string -- Default ''
    *   an additional email address the contact would want to be contacted by
    *
    *   
     */
    public $secondary_email_address;

    /**
    * @var string -- Default ''
    *   an additional phone number the contact would want to be contacted by
    *
    *   
     */
    public $secondary_phone_number;

    /**
    * @var int -- Default  nil
    *
    *   the number of bathrooms in the listing the contact has expressed interest in
    *
    *   Property of Interest (POI) attribute
    *
     */
    public $property_baths;

    /**
     * @var int -- Default nil
    *
    *   the number of bedrooms in the listing the contact has expressed interest in
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_beds;

    /**
     * @var string -- Default ''
    *
    *   the city in which the listing the contact has expressed interest in is located
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_city;

    /**
     * @var int -- Default nil
    *
    *   the list_price of the property the contact has expressed interest in
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_list_price;

    /**
    * @var property_listing_status
    *
    *   Property of Interest (POI) attribute
    *
    *   the status of the listing of  the Property of Interest; ex: 'Active' or 'Sold'
    *
    *   
     */
    public $property_listing_status;

    /**
    * @var property_mls_id
    *
    *   the MLS ID of the listing that of the Property of Interest
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_mls_id;

    /**
    * @var property_photo_url
    *
    *   a full URL to a photo of the Property of Interest
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_photo_url;

    /**
    * @var property_state
    *
    *   the state in which the listing the contact has expressed interest in is located
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_state;

    /**
    * @var property_street_address
    *
    *   the street address of the listing the contact has expressed interest in is located
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_street_address;

    /**
    * @var property_url
    *
    *   a URL referencing a HTTP(S) location which has information about the listing
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_url;

    /**
    * @var property_zip
    *
    *   the zip code in which the listing the contact has expressed interest in is located
    *
    *   Property of Interest (POI) attribute
    *
    *   
     */
    public $property_zip;

    /**
    * @var search_city
    *
    *   the city which the contact has searched for listings in
    *
    *   Property Search (PS) attribute
    *
    *   
    attr_accessor :search_city
     */
    public $search_city;

    /**
    * @var search_state
    *
    *   the state which the contact has searched for listings in
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_state;

    /**
    * @var search_zip
    *
    *   the zip code which the contact has searched for listings in
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_zip;

    /**
    * @var search_max_lot_size
    *
    *   the maximum lot size used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_max_lot_size;

    /**
     * @var int -- Default nil
    *
    *   the maximum price value used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_max_price;

    /**
     * @var int -- Default nil
    *
    *   the maximum listing square footage used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_max_sq_ft;

    /**
     * @var int -- Default nil
    *
    *   the maximum year built used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_max_year_built;

    /**
     * @var float -- Default nil
    *
    *   Property Search (PS) attribute
    *
    *   the minimum number of bathrooms used by the contact when searching for listings
    *
    *   
     *
     */
    public $search_min_baths;

    /**
     * @var int -- Default nil
    *
    *   the minimum number of bedrooms used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_min_beds;

    /**
     * @var int -- Default nil
    *
    *   the minimum price used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_min_price;

    /**
     * @var int -- Default nil
    *
    *   the minimum square footage used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
    *   
     */
    public $search_min_sq_ft;

    /**
     *
     * @var int -- Default nil
    *
    *   the minimum year built used by the contact when searching for listings
    *
    *   Property Search (PS) attribute
    *
     */
    public $search_min_year_built;

    /**
     * @var string -- Default ''
    *
    *   the property types used by the contact when searching for listings; ex: 'Condo' 'Single-Family' 'Townhouse'
    *
    *   Property Search (PS) attribute
    *
    */
    public $search_property_types;

    /**
     * Contact constructor.
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
     *  Create a Contact on The Moxi Works Platform
     * <code>
     *   MoxiworksPlatform\Contact::create([
     *     moxi_works_agent_id: '123abc',
     *     partner_contact_id: '1234',
     *     contact_name: 'george p warshington',
     *     home_street: '123 this way',
     *     home_city: 'cittyvile',
     *     home_state: 'HI',
     *     home_country: 'USA',
     *     home_neighborhood: 'my hood',
     *     job_title: 'junior bacon burner',
     *     occupation: 'chef',
     *     note: 'some notable stuff',
     *     primary_email_address: 'goo@goo.goo',
     *     primary_phone_number: '123213',
     *     property_mls_id: '1232312abcv',
     *     secondary_phone_number: '1234567890']);
     * </code>
     *
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this contact is to be associated
     *       <br><b>partner_contact_id *REQUIRED* </b>Your system's unique ID for this contact.
     *
     *       <h2>
     *     optional Contact parameters
     * </h2>
     *
     *      <br><b>contact_name</b>  full name of this contact in format "Firstname Middlename Lastname"
     *      <br><b>gender </b> can be "male" or "female" or "m" or "f"
     *      <br><b>home_street_address</b>  the street address and street on which the contact lives
     *      <br><b>home_city</b>  city or township in which this contact lives
     *      <br><b>home_state</b>  state in which this contact lives; can be abbreviation or full name
     *      <br><b>home_zip</b>  zip code in which this contact lives
     *      <br><b>home_neighborhood</b>  neighborhood in which this contact lives
     *      <br><b>home_country</b>  country in which this contact lives; can be abbreviation or full name
     *      <br><b>job_title</b>  the specific job title this contact has; ex  'Senior VP of Operations'
     *      <br><b>occupation</b> the general occupation of this contact; ex  'Software Developer'
     *      <br><b>is_new_contact</b> whether the contact was recently added to the agent's database
     *      <br><b>birthday</b> Birthday of the contact represented as a Unix Timestamp.
     *      <br><b>anniversary</b> Wedding of the contact represented as a Unix Timestamp.
     *      <br><b>home_purchase_anniversary</b> Anniversary of the contact's home purchase represented as a Unix Timestamp.
     *      <br><b>note</b> Human readable comments about this contact
     *      <br><b>partner_agent_id</b>  your system's unique ID for the agent this contact is to be associated with
     *      <br><b>primary_email_address</b>  the primary email address for this contact
     *      <br><b>primary_phone_number</b>  the primary phone number for this contact
     *      <br><b>secondary_email_address</b>  the secondary email address for this contact
     *      <br><b>secondary_phone_number</b>  the secondary phone number for this contact
     *
     *       <h2>
     *     optional Property of Interest (POI) parameters:
     *       The POI is a property that the contact has shown interest in.
     * </h2>
     *
     *      <br><b>property_baths</b>  the number of baths in the Property of Interest
     *      <br><b>property_beds</b>  the number of bedrooms in the Property of Interest
     *      <br><b>property_city</b>  the city in which the Property of Interest is located
     *      <br><b>property_list_price</b>  the list price of the Property of Interest
     *      <br><b>property_listing_status</b>  the status of the Property of Interest; ex: 'Active' or 'Sold'
     *      <br><b>property_mls_id</b>  the MLS ID of the listing
     *      <br><b>property_photo_url</b>  a full URL of an image of the Property of Interest
     *      <br><b>property_state</b>  the state which the Property of Interest is in
     *      <br><b>property_street_address</b>  the street address that the Property of Interest is on
     *      <br><b>property_url</b>  a URL to a page with more information about the Property of Interest
     *      <br><b>property_zip</b>  the zip code which the Property of Interest is in
     *
     *       <h2>
     *     optional Search Reference parameters:
     *       The Search Reference parameters reflect search criteria that the contact
     *         has used while searching for a listing
     * </h2>
     *
     *      <br><b>search_city</b>  the city or locality which this contact has searched for a listing
     *      <br><b>search_state</b>  the state in which this contact has searched for a listing
     *      <br><b>search_zip</b>  the zip code or postal code in which this contact has searched for a listing
     *      <br><b>search_max_lot_size</b>  the maximum lot size that this contact has used as criteria when searching for a listing
     *      <br><b>search_max_price</b>  the maximum price that this contact has used as criteria when searching for a listing
     *      <br><b>search_max_sq_ft</b>  the maximum square feet that this contact has used as criteria when searching for a listing
     *      <br><b>search_max_year_built</b>  the maximum year built this contact has used as criteria when searching for a listing
     *      <br><b>search_min_baths</b>  the minimum number of baths this contact has used as criteria when searching for a listing
     *      <br><b>search_min_beds</b>  the minimum number of bedrooms this contact has used as criteria when searching for a listing
     *      <br><b>search_min_lot_size</b>  the minimum lot size this contact has used as criteria when searching for a listing
     *      <br><b>search_min_price</b>  the minimum price this contact has used as criteria when searching for a listing
     *      <br><b>search_min_sq_ft</b>  the minimum number of square feet this contact has used as criteria when searching for a listing
     *      <br><b>search_min_year_built</b>  the minimum year built this contact has used as criteria when searching for a listing
     *      <br><b>search_property_types</b>  property types this contact has searched for; ex: 'Single Family, Condo, Townhouse'
     *
     *
     *
     *
     *
     * @param array $attributes
     *
     * @return Contact|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function create($attributes=[]) {
        return Contact::sendRequest('POST', $attributes);
    }

    /**
     * Find a previously created Contact on Moxi Works Platform.
     *
     * find can be performed including your system's contact id and the Moxi Works Agent ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Contact::find([moxi_works_agent_id: 'abc123', partner_contact_id: 'my_system_contact_id'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this contact is to be associated
     *       <br><b>partner_contact_id *REQUIRED* </b>Your system's unique ID for this contact.
     *
     *
     * @return Contact|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        return Contact::sendRequest('GET', $attributes);
    }

    /**
     * Search for Contact by name/email/phone on Moxi Works Platform.
     *
     * search can be performed by including contact_name and/or email_address and/or phone_number in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Contact::search([moxi_works_agent_id: 'abc123', contact_name: 'Buckminster Fuller'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this contact is to be associated
     *       <br><b>contact_name</b>full name of the contact
     *       <br><b>email_address</b>email address of the contact
     *       <br><b>phone_number</b>phone number of the contact
     *       <br> <b>updated_since</b> return all Contacts updated after this Unix timestamp
     *
     *
     * @return Array of Contact objects
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/contacts";
        $results = array();

        $required_opts = array('moxi_works_agent_id');
        $search_attrs = array('contact_name', 'phone_number', 'email_address');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        if(count(array_intersect(array_keys($attributes), $search_attrs)) == 0)
            throw new ArgumentException("at least one of " . implode(',', $search_attrs) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);
        
        if(!isset($json) || empty($json))
            return $results;

        foreach($json as $element) {
            $contact = new Contact($element);
            array_push($results, $contact);
        }
        return $results;
    }
    

    /**
    *
    * Updates a previously created Contact in Moxi Works Platform
    * <code>
    *   MoxiworksPlatform\Contact::update([
    *     moxi_works_agent_id: '123abc',
    *     partner_contact_id: '1234',
    *     contact_name: 'george p warshington',
    *     home_street: '123 this way',
    *     home_city: 'cittyvile',
    *     home_state: 'HI',
    *     home_country: 'USA',
    *     home_neighborhood: 'my hood',
    *     job_title: 'junior bacon burner',
    *     occupation: 'chef',
    *     note: 'some notable stuff',
    *     primary_email_address: 'goo@goo.goo',
    *     primary_phone_number: '123213',
    *     property_mls_id: '1232312abcv',
    *     secondary_phone_number: '1234567890']);
    * </code>
    *
    * @param array $attributes
    *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this contact is to be associated
    *       <br><b>partner_contact_id *REQUIRED* </b>Your system's unique ID for this contact.
    *
    *       <h2>
    *     optional Contact parameters
     * </h2>
    *
    *      <br><b>contact_name</b>  full name of this contact in format "Firstname Middlename Lastname"
    *      <br><b>gender </b> can be "male" or "female" or "m" or "f"
    *      <br><b>home_street_address</b>  the street address and street on which the contact lives
    *      <br><b>home_city</b>  city or township in which this contact lives
    *      <br><b>home_state</b>  state in which this contact lives; can be abbreviation or full name
    *      <br><b>home_zip</b>  zip code in which this contact lives
    *      <br><b>home_neighborhood</b>  neighborhood in which this contact lives
    *      <br><b>home_country</b>  country in which this contact lives; can be abbreviation or full name
    *      <br><b>job_title</b>  the specific job title this contact has; ex  'Senior VP of Operations'
    *      <br><b>occupation</b> occupation of this contact; ex  'Software Developer'
    *      <br><b>note</b> Human readable comments about this contact
    *      <br><b>partner_agent_id</b>  your system's unique ID for the agent this contact is to be associated with
    *      <br><b>primary_email_address</b>  the primary email address for this contact
    *      <br><b>primary_phone_number</b>  the primary phone number for this contact
    *      <br><b>secondary_email_address</b>  the secondary email address for this contact
    *      <br><b>secondary_phone_number</b>  the secondary phone number for this contact
    *
    *       <h2>
    *     optional Property of Interest (POI) parameters:
    *       The POI is a property that the contact has shown interest in.
     * </h2>
    *
    *      <br><b>property_baths</b>  the number of baths in the Property of Interest
    *      <br><b>property_beds</b>  the number of bedrooms in the Property of Interest
    *      <br><b>property_city</b>  the city in which the Property of Interest is located
    *      <br><b>property_list_price</b>  the list price of the Property of Interest
    *      <br><b>property_listing_status</b>  the status of the Property of Interest; ex: 'Active' or 'Sold'
    *      <br><b>property_mls_id</b>  the MLS ID of the listing
    *      <br><b>property_photo_url</b>  a full URL of an image of the Property of Interest
    *      <br><b>property_state</b>  the state which the Property of Interest is in
    *      <br><b>property_street_address</b>  the street address that the Property of Interest is on
    *      <br><b>property_url</b>  a URL to a page with more information about the Property of Interest
    *      <br><b>property_zip</b>  the zip code which the Property of Interest is in
    *
    *       <h2>
    *     optional Search Reference parameters:
    *       The Search Reference parameters reflect search criteria that the contact
    *         has used while searching for a listing
     * </h2>
    *
    *      <br><b>search_city</b>  the city or locality which this contact has searched for a listing
    *      <br><b>search_state</b>  the state in which this contact has searched for a listing
    *      <br><b>search_zip</b>  the zip code or postal code in which this contact has searched for a listing
    *      <br><b>search_max_lot_size</b>  the maximum lot size that this contact has used as criteria when searching for a listing
    *      <br><b>search_max_price</b>  the maximum price that this contact has used as criteria when searching for a listing
    *      <br><b>search_max_sq_ft</b>  the maximum square feet that this contact has used as criteria when searching for a listing
    *      <br><b>search_max_year_built</b>  the maximum year built this contact has used as criteria when searching for a listing
    *      <br><b>search_min_baths</b>  the minimum number of baths this contact has used as criteria when searching for a listing
    *      <br><b>search_min_beds</b>  the minimum number of bedrooms this contact has used as criteria when searching for a listing
    *      <br><b>search_min_lot_size</b>  the minimum lot size this contact has used as criteria when searching for a listing
    *      <br><b>search_min_price</b>  the minimum price this contact has used as criteria when searching for a listing
    *      <br><b>search_min_sq_ft</b>  the minimum number of square feet this contact has used as criteria when searching for a listing
    *      <br><b>search_min_year_built</b>  the minimum year built this contact has used as criteria when searching for a listing
    *      <br><b>search_property_types</b>  property types this contact has searched for; ex: 'Single Family, Condo, Townhouse'
    *
    *
    * 
    * @return Contact|null
    * @throws RemoteRequestFailureException
    */
    public static function update($attributes=[]) {
        $url = Config::getUrl() . "/api/contacts/" . $attributes['partner_contact_id'];
        return Contact::sendRequest('PUT', $attributes, $url);
    }

    /**
     * Save Contact to Moxi Works Platform
     *
     * <code>
     *   $contact = MoxiworksPlatform\Contact::find([
     *     moxi_works_agent_id: '123abc']);
     *   $contact->search_city = 'Cityville';
     *   $contact->save();
     * </code>
     *
     * @return Contact|null
     */
    public function save() {
        return Contact::update((array) $this);
    }

    /**
     * Remove a contact your system has previously created on the Moxi Works Platform from an agent
     *
     * @return Contact|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public function delete() {
        $url = Config::getUrl() . "/api/contacts/" . $this->partner_contact_id;
        return Contact::sendRequest('DELETE', (array) $this, $url);
    }

    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Contact|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/contacts";
        }
        $required_opts = array('partner_contact_id', 'moxi_works_agent_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");
        $contact = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $contact = (!isset($json) || empty($json)) ? null : new Contact($json);
        return $contact;
    }

}