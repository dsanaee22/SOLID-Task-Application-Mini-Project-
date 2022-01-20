<?php

namespace TaskApp\Controllers;

use Imanghafoori\HeyMan\Facades\HeyMan;
use Imanghafoori\HeyMan\StartGuarding;
use TaskApp\Behaviors\Protection\BannedNastyUsers;
use TaskApp\Behaviors\Protection\EnsureTaskIdIsValid;
use TaskApp\Behaviors\Protection\PreventUserToTemperOtherTasks;
use TaskApp\Behaviors\Protection\validation;
use TaskApp\Controllers\Response\Controllers\TaskCrudResponseController;
use TaskApp\DB\TaskStore;

class TaskUpdateController
{

    public function __construct()
    {
        validation::install();
        EnsureTaskIdIsValid::install('task.update');
        PreventUserToTemperOtherTasks::install('task.update');
        BannedNastyUsers::install('task.update');
        resolve(StartGuarding::class)->start();
    }

    public function update($id)
    {
        HeyMan::checkPoint('task.update');
        $task = TaskStore::update((int)$id, request()->only('name', 'description'), auth()->id());
        $task->getOr(function () {
            return TaskCrudResponseController::failedUpdate();
        });

        return TaskCrudResponseController::successUpdate();
    }


}
