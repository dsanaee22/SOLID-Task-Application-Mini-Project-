<?php

namespace TaskApp\Controllers;

use Imanghafoori\HeyMan\Facades\HeyMan;
use Imanghafoori\HeyMan\StartGuarding;
use TaskApp\Behaviors\Protection\BannedNastyUsers;
use TaskApp\Behaviors\Protection\PreventTooManyTasks;
use TaskApp\Behaviors\Protection\validation;
use TaskApp\Classes\StoreTempTag;
use TaskApp\Controllers\Response\Controllers\TaskCrudResponseController;
use TaskApp\DB\TaskStore;

class TaskStoreController
{

    public function __construct()
    {
        validation::install();
        BannedNastyUsers::install('task.store');
        PreventTooManyTasks::install();
        StoreTempTag::install();
        resolve(StartGuarding::class)->start();
    }

    public function store()
    {
        HeyMan::checkPoint('task.store');
        $task = TaskStore::store(request()->only(['name', 'description']), auth()->user()->id);

        $task->getOr(function () {
            return TaskCrudResponseController::failedDelete();
        });

        return TaskCrudResponseController::successCreate();
    }

}
