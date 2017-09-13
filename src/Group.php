<?php

namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;

class Group extends Resource
{
    /**
     * @var string the Moxi Works Platform ID of the agent
     *   moxi_works_agent_id is the Moxi Works Platform ID of the agent which a group is
     *   associated with.
     *
     *   this or agent_uuid must be set for any Moxi Works Platform transaction
     *
     */
    public $moxi_works_agent_id;

    /**
     * @var string the Moxi Works UUID of the agent
     *   agent_uuid is the ID of the agent which a group is
     *   associated with.
     *
     *   this or moxi_works_agent_id must be set for any Moxi Works Platform transaction
     *
     */
    public $agent_uuid;


    /**
     * @var string the name of the Group on the Moxi Works Platform
     *
     */
    public $moxi_works_group_name;

    /**
     * @var array an array filled with MoxiworksPlatform\Contact objects representing
     *      all the Contacts in the specified MoxiworksPlatform\Group
     *
     */
    public $contacts;


    /**
     * Group constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($data as $key => $val) {
            if (property_exists(__CLASS__, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Find a specified Group by name on the Moxi Works Platform.
     *
     * find can be performed including the Moxi Works Group name and the Moxi Works Agent ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Group::find([moxi_works_agent_id: 'abc123', moxi_works_group_name: 'groupName'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *either agent_uuid or moxi_works_agent_id are REQUIRED* </b>The Moxi Works Agent ID for the agent to which this group is to be associated
     *       <br><b>agent_uuid *either agent_uuid or moxi_works_agent_id are REQUIRED* </b>The Moxi Works Agent UUID for the agent to which this group is to be associated
     *       <br><b>moxi_works_group_name *REQUIRED* </b>The Moxi Works Group Name for this Group
     *
     *
     * @return Group|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes = [])
    {
        $contacts = array();
        $group = Group::sendRequest('GET', $attributes);
        
        if(is_null($group) || empty($group))
            return null;

        foreach ($group->contacts as $c) {
            $contact = new Contact($c);
            array_push($contacts, $contact);
        }
        $group->contacts = $contacts;
        return $group;
    }

    /**
     * Search for Groups or return all Groups for an Agent on Moxi Works Platform.
     *
     * search can be performed by including moxi_works_group_name in parameters
     *  <code>
     *  \MoxiworksPlatform\Group::search([moxi_works_agent_id: 'abc123', moxi_works_group_name: foo])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *either agent_uuid or moxi_works_agent_id are REQUIRED* </b>The Moxi Works Agent ID for the agent to which this group is to be associated
     *       <br><b>agent_uuid *either agent_uuid or moxi_works_agent_id are REQUIRED* </b>The Moxi Works Agent UUID for the agent to which this group is to be associated
     *       <br><b>name </b> string The name of the Group on Moxi Works Platform
     *
     *
     * @return Array of Group objects
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes = [])
    {
        $method = 'GET';
        $url = Config::getUrl() . "/api/groups";
        $results = array();

        $json = Resource::apiConnection($method, $url, $attributes);

        if (!isset($json) || empty($json))
            return $results;

        foreach ($json as $element) {
            $group = new Group($element);
            array_push($results, $group);
        }
        return $results;
    }


    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Group|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/groups";
        }
        $required_opts = array('moxi_works_group_name');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");
        $group = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $group = (!isset($json) || empty($json)) ? null : new Group($json);
        return $group;
    }

}
