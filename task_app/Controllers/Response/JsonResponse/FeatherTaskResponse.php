<?php


namespace TaskApp\Controllers\Response\JsonResponse;


use Illuminate\Http\JsonResponse;

class FeatherTaskResponse
{


    public function taskIdNotValid(): JsonResponse
    {
        $id = (int)request()->route()->parameter('task');
        return response()->json('error', 'Task Id : ' . $id . ' Is Not Valid !',);
    }

    public function tooManyTask(): JsonResponse
    {
        return response()->json('error', 'Number Of Tasks In Over That System Allowed !');
    }

    public function userBanned($second): JsonResponse
    {
        return response()->json('error', [
            'You Banned Because Trying To Change The CheckBox !!',
            'You Are Banned For ' . $second . ' sec '
        ]);
    }

    public function userCantManage($reason, $expire_at): JsonResponse
    {
        return response()->json('error', [
            'You Can Manage Your Tasks !',
            'Your Limit Expire In :' . $expire_at,
            'reason : ' . $reason
        ]);
    }

    public function userCantTamperTasks(): JsonResponse
    {
        return response()->json('error', 'You Cant Temper Tasks Bad Boy , You Will Be KickOf If Continue Like Evil!!',);
    }

    public function dataNotValid(): JsonResponse
    {
        return response()->json('error', 'Your Data Not Valid ! ',);
    }

}

