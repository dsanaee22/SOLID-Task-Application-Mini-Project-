<?php

namespace TaskApp\DB;

use Imanghafoori\Helpers\Nullable;
use TaskApp\Models\Task;

class TaskStore
{
    public static function store($data, $userId): Nullable
    {

        try {
            $task = Task::query()->create($data + ['user_id' => $userId]);
        } catch (\Exception $e) {
            return nullable();
        }


        if (!$task->exists()) {
            return nullable();
        }

        return nullable($task);
    }

    public static function edit($id)
    {
        $task = Task::query()->find($id);
        return $task;
    }

    public static function update($id, $data, $userId): Nullable
    {

        try {
            Task::query()->find($id)->update($data + ['user_id' => $userId]);
        } catch (\Exception $e) {
            return nullable();
        }

        $task = Task::query()->find($id)->first();
        StoreTempState::storeTag($task, now()->endOfDay(), request('state'));

        return nullable($task);
    }

    public static function destroy($id): Nullable
    {
        $task = Task::query()->find($id)->first();
        try {
            $task->delete();
        } catch (\Exception $e) {
            return nullable();
        }
        return nullable($task);
    }

    public static function countTask($userId)
    {
        return count(Task::query()->where('user_id', $userId)->get());
    }
}
