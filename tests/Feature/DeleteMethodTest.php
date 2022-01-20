<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Models\Task;
use Tests\TestCase;

class DeleteMethodTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanDelete()
    {
        $data = $this->taskData();
        $this->createTask($data);
        Task::query()->first()->get();
        $id = Task::query()->first()->id;
        $this->delete(route('task.destroy', ['task' => $id]));
        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('temp_tags', 0);
    }

    public function testUserCantDeleteTaskNotBelongsHimself()
    {
        $data = $this->taskData();
        $this->createTask($data);
        $id = Task::query()->first()->id;

        auth()->logout();
        $this->login(5);

        FeatherTaskResponseController::shouldReceive('userCantTamperTasks')->once();
        $this->delete(route('task.destroy', ['task' => $id]));
    }

    public function testTaskIdIsValidWhenDoingDeleteOperation()
    {
        FeatherTaskResponseController::shouldReceive('taskIdNotValid')->once();
        $this->delete(route('task.destroy', ['task' => 597]));
    }

    public function testUserCantDeleteWhenHeIsNotAuthentication()
    {
        $data = $this->taskData();
        $this->createTask($data);
        $id = Task::query()->first()->id;

        auth()->logout();
        $this->login(5);

        $this->delete(route('task.destroy', ['task' => $id]));
        $this->assertTrue(1 == Task::all()->count());
    }

}
