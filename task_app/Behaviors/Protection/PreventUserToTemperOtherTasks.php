<?php


namespace TaskApp\Behaviors\Protection;


use Illuminate\Support\Facades\Log;
use Imanghafoori\HeyMan\Facades\HeyMan;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Controllers\Response\Controllers\UserCantTemperTasksController;
use TaskApp\Models\Task;

class PreventUserToTemperOtherTasks
{
    public static function install($checkpoint)
    {
        HeyMan::onCheckPoint($checkpoint)
            ->thisClosureShouldAllow([self::class, 'checkTaskBelongsToUser'])
            ->otherwise()
            ->afterCalling([self::class, 'logIfUserTempered'])
            ->weRespondFrom([FeatherTaskResponseController::class, 'userCantTamperTasks']);
    }

    public function checkTaskBelongsToUser(): bool
    {
        $id = request()->route()->parameter('task');
        return ((int)auth()->id() == (int)Task::query()->find($id)->first()->user_id);
    }

    public function logIfUserTempered()
    {
        Log::alert('User Temper The Tasked !', [
            'user_id' => auth()->id(),
            'route' => request()->route()->getName(),
            'task_id' => request()->route()->parameter('task'),
        ]);
    }


}
