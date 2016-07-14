<?php

class TaskTest extends PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        \MoxiworksPlatform\Config::setUrl("https://api.moxiworks.com");
        \VCR\VCR::configure()->setCassettePath(__DIR__ . '/fixtures');
        \VCR\VCR::configure()->setMode('none');
        \VCR\VCR::turnOn();
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass()
    {
        \VCR\VCR::turnOff();
        parent::tearDownAfterClass();
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        \MoxiworksPlatform\Credentials::setSecret(null);
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setInstance(null);
        parent::tearDown();
    }


    public function testSaveThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        \MoxiworksPlatform\Credentials::setIdentifier(null);
        \MoxiworksPlatform\Credentials::setSecret(null);
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('task/update/success.yml');
        $task = new \MoxiworksPlatform\Task(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $task->save();
        \VCR\VCR::eject();
    }

    public function testSaveReturnsTaskObjectWhenSaveIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/update/success.yml');
        $task = new \MoxiworksPlatform\Task(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $response = $task->save();
        $this->assertTrue(is_a($response, '\MoxiworksPlatform\Task'));
        \VCR\VCR::eject();
    }

    public function testSaveThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/update/fail.yml');
        $task = new \MoxiworksPlatform\Task(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $response = $task->save();
        \VCR\VCR::eject();
    }


    public function testFindThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('task/find/success.yml');
        $task = \MoxiworksPlatform\Task::find(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss']);
        \VCR\VCR::eject();
    }

    public function testReturnsNullWhenFindFindsNothing() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/find/nothing.yml');
        $task = \MoxiworksPlatform\Task::find(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss']);
        $this->assertNull($task);
        \VCR\VCR::eject();
    }

    public function testReturnsTaskWhenFound() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/find/success.yml');
        $task = \MoxiworksPlatform\Task::find(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss']);
        $this->assertTrue(is_a($task, '\MoxiworksPlatform\Task'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('task/update/success.yml');
        $task = \MoxiworksPlatform\Task::update(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testUpdateReturnsTaskObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/update/success.yml');
        $task = \MoxiworksPlatform\Task::update(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $this->assertTrue(is_a($task, '\MoxiworksPlatform\Task'));
        \VCR\VCR::eject();
    }

    public function testUpdateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/update/fail.yml');
        $task = \MoxiworksPlatform\Task::update(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }


    public function testCreateThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('task/create/success.yml');
        $task = \MoxiworksPlatform\Task::create(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testCreateReturnsTaskObjectWhenUpdateIsCalled() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/create/success.yml');
        $task = \MoxiworksPlatform\Task::create(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        $this->assertTrue(is_a($task, '\MoxiworksPlatform\Task'));
        \VCR\VCR::eject();
    }

    public function testCreateThrowsRemoteRequestFailureWhenRequestFails() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\RemoteRequestFailureException');
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/create/fail.yml');
        $task = \MoxiworksPlatform\Task::create(['moxi_works_agent_id' => '1234abcd', 'partner_task_id' => 'whaterfverss', 'partner_contact_id' => 'booyuh', 'name' => 'Updated Task2', 'description' => 'Updated Task', 'status' => 'completed', 'due_at' => '1467932072', 'duration' => '20', 'completed_at' => '1467953349']);
        \VCR\VCR::eject();
    }

    public function testSearchReturnsArrayWhenRequestSucceeds() {
        $c = new \MoxiworksPlatform\Credentials('abc123', 'secret');
        \VCR\VCR::insertCassette('task/search/success.yml');
        $results = \MoxiworksPlatform\Task::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006, 'due_date_end' => 1463602226]);
        $this->assertTrue(is_array($results));
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoSearchParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('task/find/success.yml');
        $results = \MoxiworksPlatform\Task::search(['moxi_works_agent_id' => '1234abcd']);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateStartParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('task/find/success.yml');
        $results = \MoxiworksPlatform\Task::search(['moxi_works_agent_id' => '1234abcd', 'due_date_end' => 1463595006]);
        \VCR\VCR::eject();
    }

    public  function throwsExceptionWhenNoDateEndParametersPassed() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\ArgumentException');
        \VCR\VCR::insertCassette('task/find/success.yml');
        $results = \MoxiworksPlatform\Task::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006]);
        \VCR\VCR::eject();

    }

    public function testSearchThrowsExceptionWhenNoAuthorizationDataHasBeenSet() {
        $this->setExpectedException('\MoxiworksPlatform\Exception\AuthorizationException');
        \VCR\VCR::insertCassette('task/find/success.yml');
        $results = \MoxiworksPlatform\Task::search(['moxi_works_agent_id' => '1234abcd', 'due_date_start' => 1463595006, 'due_date_end' => 1463602226]);
        \VCR\VCR::eject();
    }


}