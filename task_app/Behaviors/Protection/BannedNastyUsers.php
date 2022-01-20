<?php


namespace TaskApp\Behaviors\Protection;


use Imanghafoori\HeyMan\Facades\HeyMan;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Behaviors\Utility\UserBlocker;
use TaskApp\Widgets\StateWidget;

class BannedNastyUsers
{
    public static function install($checkpoint)
    {
        HeyMan::onCheckPoint($checkpoint)
            ->thisClosureShouldAllow([self::class, 'checkNasty'])
            ->otherwise()
            ->afterCalling([UserBlocker::class, 'BlockUser'], ['reason' => 'User Blocked For Nasty Jobs !', 'second' => config('taskConfig.banTime')])
            ->weRespondFrom([FeatherTaskResponseController::class, 'userBanned'], [config('taskConfig.banTime')]);
    }


    public static function checkNasty()
    {
        $states = StateWidget::$states;
        $array = [];
        foreach ($states as $key => $state) {
            $array[] = $key;
        }
        return (in_array(request()->state, $array));
    }
}
