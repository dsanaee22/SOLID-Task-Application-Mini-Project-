<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Models\Task;
use Tests\TestCase;

class UpdateMethodTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
//
//    public function testUserCantUpdateWhenHeIsNotAuthentication()
//    {
//        $this->withoutExceptionHandling();
//        $storeData = $this->taskData();
//        $this->createTask($storeData);
//
//        \auth()->logout();
//
//        $id = Task::query()->first()->id;
//
//        $updateData = $this->taskData();
//        $this
//            ->put(route('task.update', ['task' => $id]), $updateData)
//            ->assertRedirect('/login');
//    }

    public function testUserCanUpdateTaskWhenAuthenticated()
    {
        $storeData = $this->taskData();
        $this->createTask($storeData);

        $id = Task::query()->first()->id;

//        $updateData = $this->taskData();
        $updateData = [
            'name' => 'danial',
            'description' => 'danial is a developer',
        ];
        $this->updateTask($updateData, $id);

        $task = Task::query()->latest()->first()->toArray();
        $this->assertDatabaseHas('tasks', $task);
    }


    public function testValidationInTask()
    {
        $storeData = $this->taskData();
        $this->createTask($storeData);

        $data = Task::factory()->unValidTask()->make()->toArray();
        $id = Task::query()->first()->id;
        FeatherTaskResponseController::shouldReceive('dataNotValid')->once();
        $this->updateTask($data, $id);
    }


    public function testUserCantUpdateAnotherTasksThatNotBelongsHim()
    {

        $storeData = $this->taskData();
        $this->createTask($storeData);

        $updateData = $this->taskData();
        $id = Task::query()->first()->id;

        Auth::logout();
        $this->login(2);

        FeatherTaskResponseController::shouldReceive('userCantTamperTasks')->once();
        $this->updateTask($updateData, $id);
    }

}
