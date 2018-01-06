<?php


namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;



class Gallery extends Resource {

    /**
     * @var string MLS the listing is listed with
     */
    public $list_office_aor;

    /**
     * @var string mls number for the listing
     */
    public $listing_id;

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
     *      "is_main_listing_image" =>  (Boolean) whether the image is the main image for the listing
     *      "caption" =>  (String) human readable caption for the image
     *      "description" =>  (String) human readable description of the image
     *      "width" =>  (Integer) width of the raw image
     *      "height" =>  (Integer) height of the raw image
     *      "mime_type" =>  (String) MIME or media type of the image
     * ]
     */
    public $listing_images;

    /**
     * Gallery constructor.
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
     * Find an Gallery on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works Gallery ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Gallery::find([moxi_works_agent_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Gallery ID for the gallery
     *       <br><b>agent_uuid *REQUIRED* </b>The Moxi Works Gallery ID for the gallery
     *
     *
     * @return Gallery|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $agent_identifier = $attributes['agent_uuid'] ? : $attributes['moxi_works_agent_id'];
        if(!$agent_identifier)
            throw new ArgumentException("either agent_uuid or moxi_works_agent_id is required");

        $url = Config::getUrl() . "/api/galleries/" . $agent_identifier;
        return Gallery::sendRequest('GET', $attributes, $url);
    }



    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Gallery|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/galleries";
        }
        $required_opts = array('moxi_works_company_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");
        $gallery = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $gallery = (!isset($json) || empty($json)) ? null : new Gallery($json);
        return $gallery;
    }


}
