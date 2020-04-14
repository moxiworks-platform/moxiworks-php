<?php

namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;

class EmailCampaign extends Resource {
    /**
     * @var string the MoxiWorks Platform ID of the agent
     *   moxi_works_agent_id is the MoxiWorks Platform ID of the agent which a campaign is
     *   or is to be associated with.
     *
     *   this must be set for any MoxiWorks Platform transaction
     *
     */
    public $moxi_works_agent_id;

    /**
     * @var string your system's unique ID for the contact
     *   *your system's* unique ID for the Contact associated with this campaign
     *
     *   this must be set for any MoxiWorks Platform transaction
     *
     */
    public $partner_contact_id;

    /**
     * @var string the type of this email campaign
     *
     */
    public $subscription_type;

    /**
     * @var string the email address used for this campaign
     *
     */
    public $email_address;

    /**
     * @var integer the Unix timestamp representing the date/time that this
     *   subscription was created
     *
     */
    public $subscribed_at;

    /**
     * @var string the area that this email campaign regards.
     *  This will likely be a zip code, but allow for arbitrary human readable
     *   strings referencing geographical locations.
     *
     */
    public $area;


    /**
     * @var integer the Unix timestamp representing the date/time that the
     *   last email message for this campaign was sent.
     *
     * If no email has been sent for this campaign, the value will be 0
     *
     */
    public $last_sent;

    /**
     * @var integer the Unix timestamp representing the date/time that the
     *   next email message for this campaign will be sent.
     *
     * If no email is scheduled to be sent for this campaign, the value will be 0
     *
     */
    public $next_scheduled;

    /**
     * Search for EmailCampaign on MoxiWorks Platform.
     *
     *  <code>
     *  \MoxiworksPlatform\Contact::search([moxi_works_agent_id: 'abc123', partner_contact_id: 'MySystemContactID'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The MoxiWorks Agent ID for the agent to which this contact is to be associated
     *      <br><b>partner_contact_id *REQUIRED* </b>  your system's ID for a specific contact for whom email campaigns are to be returned
     *
     *
     * @return Array of EmailCampaign objects
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/email_campaigns";
        $results = array();

        $required_opts = array('moxi_works_agent_id', 'partner_contact_id');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return $results;

        foreach($json as $element) {
            $contact = new EmailCampaign($element);
            array_push($results, $contact);
        }
        return $results;
    }



}