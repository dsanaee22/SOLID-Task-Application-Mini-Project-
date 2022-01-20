<?php


namespace TaskApp\Classes;


use TaskApp\DB\StoreTempState;
use TaskApp\Models\Task;

class StoreTempTag
{
    public static function install()
    {
        Task::created(function ($task) {
            request('state') && StoreTempState::storeTag($task, now()->endOfDay(), request('state'));
        });

        Task::deleted(function ($task) {
            StoreTempState::deleteTag($task);
        });
    }
}
