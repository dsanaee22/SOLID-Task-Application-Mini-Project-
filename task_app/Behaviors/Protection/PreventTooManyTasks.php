<?php

namespace TaskApp\Behaviors\Protection;

use Imanghafoori\HeyMan\Facades\HeyMan;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Controllers\Response\Controllers\tooManyResponse;
use TaskApp\Controllers\Response\Controllers\TooManyResponseController;
use TaskApp\Controllers\Response\HtmlResponse;
use TaskApp\Controllers\Response\Response;
use TaskApp\DB\TaskStore;
use TaskApp\Models\Task;

class PreventTooManyTasks
{

    public static function install()
    {
        HeyMan::onRoute(['task.store', 'task.create'])
            ->thisMethodShouldAllow([self::class, 'overTaskAllow'])
            ->otherwise()
            ->weRespondFrom([FeatherTaskResponseController::class, 'tooManyTask']);
    }

    public static function overTaskAllow()
    {
        return TaskStore::countTask(auth()->user()->id) < config('taskConfig.numberOfMaxTasksThatUserCanDo');
    }

}
