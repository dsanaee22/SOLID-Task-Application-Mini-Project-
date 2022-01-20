<?php

namespace TaskApp\Behaviors\Utility;

use Illuminate\Support\Facades\Log;

class UserBlocker
{
    const ReasonNotSet = 'The Reason Is Not Set';

    public static function BlockUser($reason = self::ReasonNotSet, $user = null, $second = 120)
    {
        $user = $user ?: auth()->user();
        $end = now()->addSeconds($second);
        tempTags($user)->tagIt('Banned', $end, ['reason' => $reason]);
    }

    public static function isBanned($user)
    {
        return (bool)tempTags($user)->getActiveTag('banned');
    }

    public static function InsertLogToSystem($user, $second = 120, $reason = self::ReasonNotSet)
    {
        Log::alert('Banned User kicked Out !', [
            'user' => $user->id,
            'reason' => $reason,
            'second ' => $second,
            'route' => request()->route()->getName(),
        ]);
    }

}
