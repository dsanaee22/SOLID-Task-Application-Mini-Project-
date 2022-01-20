<?php

namespace TaskApp\Widgets;

class StateWidget
{

    public $template = 'Task::StateWidgetView';

    public $cacheLifeTime = 10;

    public static $states = [
        1 => 'Done',
        2 => 'Doing',
        3 => 'Failed',
        4 => 'Skipped',
        5 => 'Not Started',
    ];

    public function data()
    {
        return ['states' => self::$states];
    }

}
