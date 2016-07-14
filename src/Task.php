<?php

namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;

class Task extends Resource {
    /**
     * @var string the Moxi Works Platform ID of the agent
     *   moxi_works_agent_id is the Moxi Works Platform ID of the agent which a task is
     *   or is to be associated with.
     *
     *   this must be set for any Moxi Works Platform transaction
     *
     */
    public $moxi_works_agent_id;

    /**
     * @var string your system's unique ID for the contact
     *   *your system's* unique ID for the Contact associated with this Task
     *
     *   this must be set for any Moxi Works Platform transaction
     *
     */
    public $partner_contact_id;

    /**
     * @var string your system's unique ID for the task
     *   *your system's* unique ID for the Task
     *
     *   this must be set for any Moxi Works Platform transaction
     *
     */
    public $partner_task_id;


    /**
     * @var string -- Default ''
     *   the title to be displayed for this task
     *
     */
    public $name;

    /**
     * @var string -- Default ''
     *   a description of this task (max 255 characters)
     *
     */
    public $description;

    /**
     * @var integer
     *   the Unix timestamp representing the due date of this Task
     *
     *  this must be set when creating or updating a Task
     *
     */
    public $due_at;

    /**
     * @var string, Enumerated -- 'active' or 'completed' -- Default 'active'
     *   the status of this task.
     *
     *   allowed values:
     *     active
     *     completed
     *     [nil]
     *
     *   When creating a new task, the assumed state is 'active;' this attribute does
     *   not need to be populated when creating or updating a Task unless the
     *   status is 'completed.'
     *
     */
    public $status;

    /**
     * @var integer
     *   the Unix timestamp representing the creation date of this Task
     *
     *  this is a read-only attribute which gets set automatically on creation of
     *  the task in the Moxi Works Platform
     */
    public $created_at;

    /**
     * @var integer
     *   the Unix timestamp representing the completion date of this Task
     *
     *   When the task is not in a 'completed' state, this attribute will be nil.
     *
     *   When updating the <i>completed_at</i> attribute, the <i>status</i> attribute must
     *   be set to <b>completed</b>
     *
     *
     */
    public $completed_at;

    /**
     * @var integer
     *   the time (in minutes) that the task is expected to take to complete
     *
     *
     */
    public $duration;

    /**
     * Task constructor.
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
     *  Create a Task on The Moxi Works Platform
     * <code>
     *   MoxiworksPlatform\Task::create([
     *     moxi_works_agent_id: '123abc',
     *     partner_contact_id: '1234',
     *     partner_task_id: 'mySystemsTaskID',
     *     name: 'pick up keys',
     *     description: 'pick up keys from 1234 there ave',
     *     due_at: 1463595006,
     *     duration: 30]);
     * </code>
     *
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this task is to be associated
     *       <br><b>partner_contact_id *REQUIRED* </b>Your system's unique ID for the contact associated with this task.
     *       <br><b>partner_task_id *REQUIRED* </b>Your system's unique ID for this task.
     *       <br><b>due_at *REQUIRED* </b>Unix timestamp representing the due date of this task
     *       <br><b>duration *REQUIRED* </b>the length in minutes that the task is expected to take
     *       <h2>
     *     optional Task parameters
     * </h2>
     *
     *      <br><b>name</b>  short description of the task to be displayed
     *      <br><b>description</b> a more detailed description of the task (max 255 characters)
     *
     *
     *
     * @param array $attributes
     *
     * @return Task|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function create($attributes=[]) {
        return Task::sendRequest('POST', $attributes);
    }

    /**
     *  Update a previously created Task on The Moxi Works Platform
     * <code>
     *   MoxiworksPlatform\Task::update([
     *     moxi_works_agent_id: '123abc',
     *     partner_contact_id: '1234',
     *     partner_task_id: 'mySystemsTaskID',
     *     name: 'pick up keys',
     *     description: 'pick up keys from 1234 there ave',
     *     due_at: 1463595006,
     *     duration: 30,
     *     status: 'completed',
     *     completed_at: 1463598765]);
     * </code>
     *
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this task is to be associated
     *       <br><b>partner_contact_id *REQUIRED* </b>Your system's unique ID for the contact associated with this task.
     *       <br><b>partner_task_id *REQUIRED* </b>Your system's unique ID for this task.
     *       <br><b>due_at *REQUIRED* </b>Unix timestamp representing the due date of this task
     *       <br><b>duration *REQUIRED* </b>the length in minutes that the task is expected to take
     *       <h2>
     *     optional Task parameters
     * </h2>
     *
     *      <br><b>name</b>  short description of the task to be displayed
     *      <br><b>description</b> a more detailed description of the task (max 255 characters)
     *      <br><b>completed_at</b>  Unix timestamp representing the date / time the task was completed
     *      <br><b>status</b>  short description of the task to be displayed
     *
     *
     *
     * @param array $attributes
     *
     * @return Task|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function update($attributes=[]) {
        $url = Config::getUrl() . "/api/tasks/" . $attributes['partner_task_id'];
        return Task::sendRequest('PUT', $attributes, $url);
    }


    /**
     * Find a previously created Task on Moxi Works Platform.
     *
     * find can be performed including your system's task id and the Moxi Works Agent ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Task::find([moxi_works_agent_id: 'abc123', partner_task_id: 'my_system_task_id'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b>The Moxi Works Agent ID for the agent to which this task is to be associated
     *       <br><b>partner_task_id *REQUIRED* </b>Your system's unique ID for this task.
     *
     *
     * @return Task|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        return Task::sendRequest('GET', $attributes);
    }

    /**
     * Search for Tasks between start/end date on Moxi Works Platform.
     *
     * search can be performed by including due_date_start and due_date_end in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Task::search([moxi_works_agent_id: 'abc123', date_start: 1463595006, date_end: 1463599996])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_agent_id *REQUIRED* </b> string The Moxi Works Agent ID for the agent to which this task is associated
     *       <br><b>date_start *REQUIRED*</b> integer  Unix timestamp representing the start time for the search
     *       <br><b>date_end *REQUIRED* </b>integer Unix timestamp representing the end time for the search
     *
     *       <h2>
     *     optional Task search parameters
     * </h2>
     *      <br><b>partner_contact_id</b>  your system's ID for a specific contact for whom tasks are to be returned
     *      <br><b>page_number</b>  page number of responses to return (if number of responses spans a beyond a single page of responses)
     *
     * @return Array paged response array with the format:
     *   [
     *     page_number: [Integer],
     *     total_pages: [Integer],
     *     tasks:  [Array] containing MoxiworkPlatform\Task objects
     *   ]
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        $method = 'GET';
        $url = Config::getUrl() . "/api/tasks";
        $tasks = array();

        $required_opts = array('moxi_works_agent_id', 'due_date_start', 'due_date_end');

        if(count(array_intersect(array_keys($attributes), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");

        $json = Resource::apiConnection($method, $url, $attributes);

        if(!isset($json) || empty($json))
            return null;

        foreach ($json['tasks'] as $c) {
            $task = new Task($c);
            array_push($tasks, $task);
        }
        $json['tasks'] = $tasks;
        return $json;
    }


    /**
     * Save Task to Moxi Works Platform
     *
     * <code>
     *   $task = MoxiworksPlatform\Task::find([
     *     moxi_works_agent_id: '123abc']);
     *   $task->search_city = 'Cityville';
     *   $task->save();
     * </code>
     *
     * @return Task|null
     */
    public function save() {
        return Task::update((array) $this);
    }



    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Task|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/tasks";
        }
        $required_opts = array('partner_task_id', 'moxi_works_agent_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " are required");
        $task = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $task = (!isset($json) || empty($json)) ? null : new Task($json);
        return $task;
    }

}