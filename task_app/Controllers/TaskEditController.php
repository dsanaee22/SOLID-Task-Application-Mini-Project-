<?php

namespace TaskApp\Controllers;

use Imanghafoori\HeyMan\Facades\HeyMan;

use Imanghafoori\HeyMan\StartGuarding;
use TaskApp\Behaviors\Protection\EnsureTaskIdIsValid;
use TaskApp\Behaviors\Protection\PreventUserToTemperOtherTasks;
use TaskApp\Controllers\Response\Controllers\TaskCrudResponseController;
use TaskApp\DB\TaskStore;

class TaskEditController
{
  public function __construct()
  {
      EnsureTaskIdIsValid::install('task.edit');
      PreventUserToTemperOtherTasks::install('task.edit');
      resolve(StartGuarding::class)->start();
  }

    public function edit($id)
    {
        HeyMan::checkPoint('task.edit');
        $task = TaskStore::edit($id);
        $task->getOr(function () {
            return TaskCrudResponseController::failedShowEditForm();
        });
        return TaskCrudResponseController::showEditForm($task);
    }

}
