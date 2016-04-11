<?php


namespace MoxiworksPlatform;

use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;


class Contact extends Resource{

    public $moxi_works_agent_id;
    public $partner_contact_id;
    public $moxi_works_contact_id;
    public $business_website;
    public $contact_name;
    public $gender;
    public $home_street_address;
    public $home_city;
    public $home_state;
    public $home_zip;
    public $home_neighborhood;
    public $home_country;
    public $job_title;
    public $occupation;
    public $partner_agent_id;
    public $primary_email_address;
    public $primary_phone_number;
    public $secondary_email_address;
    public $secondary_phone_number;
    public $property_baths;
    public $property_beds;
    public $property_city;
    public $property_list_price;
    public $property_listing_status;
    public $property_mls_id;
    public $property_photo_url;
    public $property_state;
    public $property_street_address;
    public $property_url;
    public $property_zip;
    public $search_city;
    public $search_state;
    public $search_zip;
    public $search_max_lot_size;
    public $search_max_price;
    public $search_max_sq_ft;
    public $search_max_year_built;
    public $search_min_baths;
    public $search_min_beds;
    public $search_min_price;
    public $search_min_sq_ft;
    public $search_min_year_built;
    public $search_property_types;

    function __construct(array $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                $this->$key = $val;
            }
        }
    }

    public static function create($attributes=[]) {
        return Contact::sendRequest('POST', $attributes);
    }

    public static function find($attributes=[]) {
        return Contact::sendRequest('GET', $attributes);
    }

    public static function update($attributes=[]) {
        $url = Config::getUrl() . "/api/contacts/" . $attributes['partner_contact_id'];
        return Contact::sendRequest('PUT', $attributes, $url);
    }

    public function save() {
        return Contact::update((array) $this);
    }

    public function delete() {
        $url = Config::getUrl() . "/api/contacts/" . $this->partner_contact_id;
        return Contact::sendRequest('DELETE', (array) $this, $url);
    }

    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/contacts";
        }
        $required_opts = array('partner_contact_id', 'moxi_works_agent_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");
        $contact = null;
        $client = new \GuzzleHttp\Client();
        $type = ($method == 'GET') ? 'query' : 'form_params';
        $query = [
            $type => $opts,
            'headers' =>  Resource::headers(),
            'debug' => Config::getDebug()
        ];
        $res = $client->request($method, $url, $query);
        $body = $res->getBody();
        try {
            $json = json_decode($body, true);
        } catch (\Exception $e) {
            throw new RemoteRequestFailureException("unable to parse remote response $e\n response:\n  $body");
        }
        Contact::checkForErrorInResponse($json);
        $contact = (!isset($json) || empty($json)) ? null : new Contact($json);
        return $contact;
    }

}