<?php

namespace TaskApp\Behaviors\Protection;

use Imanghafoori\HeyMan\Facades\HeyMan;

class auth
{
    public static function install()
    {
        HeyMan::whenYouHitRouteName('task.*')
            ->checkAuth()
            ->otherwise()
            ->redirect()->guest('/login');
    }
}

?>
