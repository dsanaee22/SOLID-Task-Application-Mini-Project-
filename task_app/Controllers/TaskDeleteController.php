<?php

namespace TaskApp\Controllers;

use Imanghafoori\HeyMan\Facades\HeyMan;
use Imanghafoori\HeyMan\StartGuarding;
use TaskApp\Behaviors\Protection\EnsureTaskIdIsValid;
use TaskApp\Behaviors\Protection\PreventUserToTemperOtherTasks;
use TaskApp\Classes\StoreTempTag;
use TaskApp\Controllers\Response\Controllers\TaskCrudResponseController;
use TaskApp\DB\TaskStore;

class TaskDeleteController
{

    public function __construct()
    {
        EnsureTaskIdIsValid::install('task.destroy');
        PreventUserToTemperOtherTasks::install('task.destroy');
        StoreTempTag::install();
        resolve(StartGuarding::class)->start();
    }

    public function destroy($id)
    {
        HeyMan::checkPoint('task.destroy');
        $task = TaskStore::destroy($id);

        $task->getOr(function () {
            return TaskCrudResponseController::failedDelete();
        });

        return TaskCrudResponseController::successDelete();
    }

}
