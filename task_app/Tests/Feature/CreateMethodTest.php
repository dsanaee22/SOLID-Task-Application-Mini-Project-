<?php

namespace Tests\Feature;

use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Models\Task;
use Tests\TestCase;

class CreateMethodTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotSeeTasksPagesWhenNotAuthenticated()
    {
        auth()->logout();
        $this
            ->get(route('task.create'))
            ->assertRedirect('/login');
    }

    public function testUserCanSeeAndPreformWhenAuthenticated()
    {
        $this->get(route('task.create'))
            ->assertOk()
            ->assertViewIs('Task::create');
    }

    public function testUserCantSeeCreatePageWhenTasksIsMoreThanX()
    {
        $count = config()->get('taskConfig.numberOfMaxTasksThatUserCanDo');
        Task::factory()->count($count)->withSameUser(auth()->id())->create();

        $task1 = $this->taskData();
        $this->createTask($task1);

        FeatherTaskResponseController::shouldReceive('tooManyTask')->once();
        $this->get(route('task.create'));
    }

}
