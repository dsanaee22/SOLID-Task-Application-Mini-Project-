<?php

namespace TaskApp\Behaviors\Protection;

use Imanghafoori\HeyMan\Facades\HeyMan;
use TaskApp\Controllers\Response\Controllers\FeatherTaskResponseController;
use TaskApp\Controllers\Response\Controllers\ValidationController;

class validation
{
    public static function install()
    {
        HeyMan::onRoute(['task.store','task.update'])
            ->yourRequestShouldBeValid([
                'name' => 'required'
            ])
            ->otherwise()
            ->weRespondFrom([FeatherTaskResponseController::class, 'dataNotValid']);
    }
}
