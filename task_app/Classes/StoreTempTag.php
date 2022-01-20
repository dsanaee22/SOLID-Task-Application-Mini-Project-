<?php


namespace TaskApp\Classes;


use TaskApp\Models\Task;

class StoreTempTag
{
    public static function install()
    {
        Task::created(function ($task) {
            StoreTempState::storeTag($task, now()->endOfDay(), request('state'));
        });

//        Task::updated(function ($task) {
//            StoreTempState::storeTag($task, now()->endOfDay(), request('state'));
//        });

        Task::deleted(function ($task) {
            StoreTempState::deleteTag($task);
        });
    }
}
