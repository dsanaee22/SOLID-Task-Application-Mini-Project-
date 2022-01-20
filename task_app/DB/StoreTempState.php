<?php


namespace TaskApp\DB;


use TaskApp\Models\Task;

class StoreTempState
{
    const notStarted = 5;

    public static function storeTag($model, $expireTime, $state)
    {
        tempTags($model)->tagIt('state', $expireTime, ['value' => $state]);
    }

    public static function deleteTag($model)
    {
        tempTags($model)->unTag();
    }

    public static function getState($model)
    {
        $state = tempTags($model)->getActiveTag('state');
        if (!$state)
            return self::notStarted;
        return $state->value;
    }
}
