<?php

namespace MoxiworksPlatform;


use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\Translation\Tests\StringClass;


class Company {

    /**
     * @var string the Moxi Works Platform ID of the company
     *
     *
     */
    public $moxi_works_company_id;

    /**
     * @var string the human readable name of the company
     *
     *
     */
    public $name;


    /**
     * @var Array partner data associated with the company
     *
     *
     */
    public $partners;

    /**
     * Company constructor.
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
     * Find a Company on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works Company ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Company::find([moxi_works_company_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_company_id *REQUIRED* </b>The Moxi Works Company ID
     *
     *
     * @return Company|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $required_opts = array('moxi_works_company_id');

        if (count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");

        $url = Config::getUrl() . "/api/companies/" . $attributes['moxi_works_company_id'];

        return Company::sendRequest('GET', [], $url);
    }

    /**
     * Search for Companies on Moxi Works Platform.
     *
     *  <code>
     *  \MoxiworksPlatform\Company::search()
     *  </code>
     *
     * @return Array of Group objects
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {


        $method = 'GET';
        $url = Config::getUrl() . "/api/companies";
        $results = array();

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return $results;

        foreach($json as $element) {
            $company = new Company($element);
            array_push($results, $company);
        }

        return $results;
    }

    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Company|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/companies";
        }

        $company = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $company = (!isset($json) || empty($json)) ? null : new Company($json);
        return $company;
    }



}