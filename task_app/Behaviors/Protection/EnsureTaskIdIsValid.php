<?php


namespace TaskApp\Behaviors\Protection;

use Illuminate\Support\Facades\Log;
use Imanghafoori\HeyMan\Facades\HeyMan;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Models\Task;

class EnsureTaskIdIsValid
{
    public static function install($checkpoint)
    {
        HeyMan::onCheckPoint($checkpoint)
            ->thisMethodShouldAllow([static::class, 'IsTaskValid'])
            ->otherwise()
            ->afterCalling([self::class, 'LogTask'])
            ->weRespondFrom([FeatherTaskResponseController::class, 'taskIdNotValid']);
    }

    public static function IsTaskValid()
    {
        $id = (int)request()->route()->parameter('task');
        return is_numeric($id) && Task::query()->find($id);
    }

    public static function LogTask()
    {
        $id = (int)request()->route()->parameter('task');
        Log::alert('User Trying To Get Not Valid Task ! ', [
            'user_id' => auth()->id(),
            'route' => request()->route()->getName(),
            'task_id' => $id,
        ]);
    }
}
