<?php

namespace Tests\Feature;

use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Models\Task;
use Tests\TestCase;

class StoreMethodTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCantStoreWhenHeIsNotAuthentication()
    {
        \auth()->logout();
        $data = $this->taskData();
        $beforeSubmit = Task::all()->count();
        $this->createTask($data);
        $afterSubmit = Task::all()->count();
        $this->assertTrue($beforeSubmit == $afterSubmit);
    }

    public function testUserCanAddTask()
    {
        $data = $this->taskData();
        $this->createTask($data);
        $afterSubmit = Task::all()->count();
        $this->assertTrue(0 == $afterSubmit - 1);
        $this->assertDatabaseCount('temp_tags', 1);
    }

    public function testUserCantSubmitMoreThanXTasks()
    {
        $count = config()->get('taskConfig.numberOfMaxTasksThatUserCanDo');
        Task::factory()->count($count)->withSameUser(auth()->id())->create();

        $task1 = $this->taskData();
        $this->createTask($task1);

        $afterSubmit = Task::all()->count();
        $this->assertTrue($count == $afterSubmit);
    }

    public function testValidationInTask()
    {
        $data = Task::factory()->unValidTask()->make()->toArray();
        FeatherTaskResponseController::shouldReceive('dataNotValid')->once();
        $this->createTask($data);
        $afterSubmit = Task::all()->count();
        $this->assertTrue(0 == $afterSubmit);
    }

}
