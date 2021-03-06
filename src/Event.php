<?php

namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;

class Event extends Resource {

    /**
     * @var string the Moxi Works Platform ID of the agent
     *   moxi_works_agent_id is the Moxi Works Platform ID of the agent which a event is
     *   or is to be associated with.
     *
     *   this must be set for any Moxi Works Platform transaction
     *
     */
    public $moxi_works_agent_id;

    /**
     * @var string your system's unique ID for the event
     *   *your system's* unique ID for the Event
     *
     *   this must be set for any Moxi Works Platform transaction
     *
     */
    public $partner_event_id;

    /**
     * @var string a short description of the event
     *
     */
    public $event_subject;

    /**
     * @var string a short description of the location of the event
     *
     */
    public $event_location;

    /**
     * @var string a more detailed description of the event.
     *
     * Any HTML formatting will be removed in the response
     */
    public $note;

    /**
     * @var integer how many minutes before to send a reminder.
     *  do not set, or set to null if you don't want a reminder sent.
     */
    public $remind_minutes_before;

    /**
     * @var boolean whether the event is a meeting or not
     *
     */
    public $is_meeting;

    /**
     * @var integer Unix timestamp representing start time of the event
     *
     */
    public $event_start;

    /**
     * @var integer Unix timestamp representing the end time of the event
     */
    public $event_end;

    /**
     * @var boolean whether the event is an all day event
     *
     */
    public $all_day;

    /**
     * @var string a comma separated list of attendee IDs using Contact IDs from your system (partner_contact_id) that have already been added to The Moxi Works Platform as a Contact
     *
     * Contact must already have been created in order to be added as an attendee.
     *
     */
    public $attendees;


    /**
     * @var boolean whether a reminder should be sent to attendees
     *
     */
    public $send_reminder;


    /**
     * Event constructor.
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
     *  Create an Event on The Moxi Works Platform
     * <code>
     *   MoxiworksPlatform\Event::create([
     *     moxi_works_agent_id: '123abc',
     *     partner_event_id: '1234',
     *     event_subject: 'Birthday Party',
     *     event_location: '123 this way, cityville, Stateswhere 86753',
     *     note: 'this is going to be the birthday. we like birthdays',
     *     remind_minutes_before: 23,
     *     is_meeting: true,
     *     event_start: 1463595006,
     *     event_end: 1463602226]);
     * </code>
     *
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this event is to be associated
     *       <br><b>partner_event_id *REQUIRED* </b>Your system's unique ID for this event.
     *
     *       <h2>
     *     optional Event parameters
     *
     *      <br><b>event_subject</b>  string  string a short description of the event
     *      <br><b>event_location</b>  string a short description of the location of the event
     *      <br><b>note</b>  string  a more detailed description of the event.
     *      <br><b>remind_minutes_before</b> integer  how many minutes before to send a reminder.
     *      <br><b>is_meeting</b> boolean  whether the event is a meeting or not
     *      <br><b>event_start</b>  integer Unix timestamp representing start time of the event
     *      <br><b>event_end</b>   integer Unix timestamp representing the end time of the event
     *      <br><b>all_day</b> boolean  whether the event is an all day event
     *
     * </h2>
     *
     * @return Event|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function create($attributes=[]) {
        return Event::sendRequest('POST', $attributes);
    }

    /**
     * Find a previously created Event on Moxi Works Platform.
     *
     * find can be performed including your system's event id and the Moxi Works Agent ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Event::find([moxi_works_agent_id: 'abc123', partner_event_id: 'my_system_event_id'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this event is to be associated
     *       <br><b>partner_event_id *REQUIRED* </b>Your system's unique ID for this event.
     *
     *
     * @return Event|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        return Event::sendRequest('GET', $attributes);
    }

    /**
     * Search for Events between start/end date on Moxi Works Platform.
     *
     * search can be performed by including date_start and date_end in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Event::search([moxi_works_agent_id: 'abc123', date_start: 1463595006, date_end: 1463599996])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b> string The Moxi Works Agent ID for the agent to which this event is associated
     *       <br><b>date_start *REQUIRED*</b> integer  Unix timestamp representing the start time for the search
     *       <br><b>date_end *REQUIRED* </b>integer Unix timestamp representing the end time for the search
     *
     *
     * @return Array of Event objects formatted as follows:
     *  {   "date" => "MM/DD/YY",
     *     "events" => [ \MoxiworkPlatform\Event, \MoxiworkPlatform\Event ]
     *   }
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/events";
        $results = array();

        $required_opts = array('moxi_works_agent_id', 'date_start', 'date_end');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return $results;

        foreach($json as $element) {
            $event = new Event($element);
            array_push($results, $event);
        }
        return $results;
    }

    /**
     *  Update a previously created Event on The Moxi Works Platform
     * <code>
     *   MoxiworksPlatform\Event::update([
     *     moxi_works_agent_id: '123abc',
     *     partner_event_id: '1234',
     *     event_subject: 'Birthday Party',
     *     event_location: '123 this way, cityville, Stateswhere 86753',
     *     note: 'this is going to be the birthday. we like birthdays',
     *     remind_minutes_before: 23,
     *     is_meeting: true,
     *     event_start: 1463595006,
     *     event_end: 1463602226]);
     * </code>
     *
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this event is to be associated
     *       <br><b>partner_event_id *REQUIRED* </b>Your system's unique ID for this event.
     *
     *       <h2>
     *     optional Event parameters
     *
     *      <br><b>event_subject</b>  string  string a short description of the event
     *      <br><b>event_location</b>  string a short description of the location of the event
     *      <br><b>note</b>  string  a more detailed description of the event.
     *      <br><b>remind_minutes_before</b> integer  how many minutes before to send a reminder.
     *      <br><b>is_meeting</b> boolean  whether the event is a meeting or not
     *      <br><b>event_start</b>  integer Unix timestamp representing start time of the event
     *      <br><b>event_end</b>   integer Unix timestamp representing the end time of the event
     *      <br><b>all_day</b> boolean  whether the event is an all day event
     *
     * </h2>
     *
     * @return Event|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function update($attributes=[]) {
        $url = Config::getUrl() . "/api/events/" . $attributes['partner_event_id'];
        return Event::sendRequest('PUT', $attributes, $url);
    }

    /**
     * Save Event to Moxi Works Platform
     *
     * <code>
     *   $event = MoxiworksPlatform\Event::find([
     *     moxi_works_agent_id: '123abc']);
     *   $event->search_city = 'Cityville';
     *   $event->save();
     * </code>
     *
     * @return Event|null
     */
    public function save() {
        return Event::update((array) $this);
    }


    /**
     * Remove a event your system has previously created on the Moxi Works Platform from an agent
     *
     * @return Event|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public function delete() {
        $url = Config::getUrl() . "/api/events/" . $this->partner_event_id;
        return Event::sendRequest('DELETE', (array) $this, $url);
    }
    

    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Event|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/events";
        }
        $required_opts = array('partner_event_id', 'moxi_works_agent_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");
        $event = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $event = (!isset($json) || empty($json)) ? null : new Event($json);
        return $event;
    }


}