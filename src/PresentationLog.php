<?php

namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;



class PresentationLog extends Resource {

    /**
     * @var string This is the MoxiWorks Platform ID of the presentation_log which an ActionLog entry is associated with. This will be an RFC 4122 compliant UUID.
     */
    public $agent_uuid;


    /**
     * @var string First name of agent. This can be null if there is no data for this attribute.
     */
    public $agent_fname;


    /**
     * @var string Last name of agent. This can be null if there is no data for this attribute.
     */
    public $agent_lname;


    /**
     * @var string The title of the presentation. This can be null if there is no data for this attribute.
     */
    public $title;


    /**
     * @var string This is the Unix timestamp for the creation time of the presentation.
     */
    public $created;


    /**
     * @var string This is the Unix timestamp for the last time the presentation was edited.
     */
    public $edited;


    /**
     * @var string This is the ID of the office for the Agent associated with the presentation. This will be an integer.
     */
    public $agent_office_id;


    /**
     * @var string Whether the presentation is for a buyer or seller.
     */
    public $type;


    /**
     * @var string The UUID of the agent that sent the presentation to the client. This will be an RFC 4122 compliant UUID.
     */
    public $sent_by_agent;


    /**
     * @var string The number of PDF documents requested.
     */
    public $pdf_requested;


    /**
     * @var string The number of Online presentations requested.
     */
    public $pres_requested;


    /**
     * @var string This is the ID of the Agent utilized by their company.
     */
    public $external_identifier;


    /**
     * @var string This is the ID of the office for this Agent utilized by their company.
     */
    public $external_office_id;

    /**
     * @var string The unique UUID of the presentation. This will be an RFC 4122 compliant UUID.
     */
    public $moxi_works_presentation_id;


    /**
     * PresentationLog constructor.
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
     * Search for PresentationLogs by Agent ID on MoxiWorks Platform.
     *
     * search can be performed by including moxi_works_company_id and updated_since in a parameter array
     *  <code>
     *  \MoxiworksPlatform\PresentationLog::search([created_after: 1234, created_before: 2345])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_company_id  </b> string The MoxiWorks Company ID for the company in which we are searching for presentation logs
     *       <h2>
     *     optional Task search parameters
     * </h2>
     *       <br><b>updated_after </b> integer  Unix timestamp representing the start time for the search. If no <i>updated_after</i> parameter is included in the request, only presentations updated in the last seven days will be included in the response.
     *       <br><b>updated_before </b> integer  Unix timestamp representing the end time for the search. If no <i>updated_before</i> parameter is included in the request, only presentations updated in the seven days following <i>updated_after</i> will be included in the response.
     *       <br><b>created_after </b> integer  Unix timestamp representing the start time for the search.
     *       <br><b>created_before </b> integer  Unix timestamp representing the end time for the search. If no <i>created_before</i> parameter is included in the request, only presentations updated in the seven days following <i>created_after</i> will be included in the response.
     *
     * Note: only updated_after and <b>updated_before</b> <b>or</b>
     *  <b>created_after</b> and <b>created_before</b> can be used when searching.
     *
     *
     * @return Array paged response array with the format:
     *   [
     *     page_number: [Integer],
     *     total_pages: [Integer],
     *     agents:  [Array] containing MoxiworkPlatform\PresentationLog objects
     *   ]
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/presentation_logs";
        $presentation_logs = array();

        $required_opts = array('moxi_works_company_id');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return null;

        foreach ($json['presentations'] as $c) {
            $presentation_log = new PresentationLog($c);
            array_push($presentation_logs, $presentation_log);
        }
        $json['presentations'] = $presentation_logs;
        return $json;
    }

    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return PresentationLog|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/presentation_logs";
        }
        $required_opts = array('moxi_works_company_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");
        $presentation_log = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $presentation_log = (!isset($json) || empty($json)) ? null : new PresentationLog($json);
        return $presentation_log;
    }


}