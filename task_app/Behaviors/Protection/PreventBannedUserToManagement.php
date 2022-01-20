<?php


namespace TaskApp\Behaviors\Protection;


use Illuminate\Support\Facades\Log;
use Imanghafoori\HeyMan\Facades\HeyMan;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Controllers\Response\Controllers\YouAreBannedController;
use TaskApp\Behaviors\Utility\UserBlocker;



class PreventBannedUserToManagement
{

    public static function install()
    {
        HeyMan::onRoute([
            'task.create',
            'task.store',
            'task.edit',
            'task.update',
            'task.destroy',
        ])->thisMethodShouldAllow([self::class, 'isNotBanned'])
            ->otherwise()
            ->afterCalling([self::class, 'LogBanned'])
            ->weRespondFrom([self::class, 'youAreBanned']);
    }


    public static function isNotBanned()
    {
        return ! UserBlocker::isBanned(auth()->user());
    }

    public function LogBanned()
    {
        UserBlocker::InsertLogToSystem(auth()->user(),config('taskConfig.banTime'),'The User Change Select Boxes !');
    }

    public static function youAreBanned()
    {
        $tag = tempTags(auth()->user())->getActiveTag('banned');
        $reason = $tag->getPayload('reason');
        return FeatherTaskResponseController::userCantManage($reason,$tag->expire_at);
    }

}
