<?php

namespace Tests\Feature;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use TaskApp\Behaviors\Utility\UserBlocker;
use TaskApp\Controllers\Response\Controllers\TaskCrudResponseController;
use TaskApp\DB\StoreTempState;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Models\Task;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCanNotManagementWhenDoNastyWorks()
    {
        UserBlocker::BlockUser('You Are Bad Boy', auth()->user(), 180);
        FeatherTaskResponseController::shouldReceive('userCantManage')->once();
        $this->get(route('task.create'));
    }

    public function testUserCantEditAnotherTasksThatNotBelongsHim()
    {
        $data = $this->taskData();
        $this->createTask($data);
        $id = Task::query()->first()->id;
        Auth::logout();
        $this->login(2);
        FeatherTaskResponseController::shouldReceive('userCantTamperTasks')->once();
        $this->get(route('task.edit', ['task' => $id]));
    }

    public function testUserCanSeeEditForm()
    {
        $data = $this->taskData();
        $this->createTask($data);

        $task = Task::query()->first()->id;

        TaskCrudResponseController::shouldReceive('showEditForm')->once();
        $this->get(route('task.edit', ['task' => $task]));
    }

    public function testTaskExpireAfterEndDay()
    {
        $data = $this->taskData();
        $this->createTask($data);
        $task = Task::query()->first();
        Carbon::setTestNow(now()->endOfDay()->addSecond());
        $this->assertEquals(5, StoreTempState::getState($task));
    }

    public function testTaskIdIsValid(){
        FeatherTaskResponseController::shouldReceive('taskIdNotValid')->once();
        $this->get(route('task.edit', ['task' => 50]));
    }

}
