<?php


namespace TaskApp\Controllers\Response\JsonResponse;


use Illuminate\Support\Facades\Facade;
use TaskApp\Controllers\Response\HtmlResponse\failedOpenEditForm;
use TaskApp\Controllers\Response\HtmlResponse\failedTaskAdded;
use TaskApp\Controllers\Response\JsonResponse\EnsureTaskIdIsValidMessage;

class TaskCrudResponse
{
    public function success()
    {
        $id = (int)request()->route()->parameter('task');
        return response()->json('success', 'Task : ' . $id . ' Successfully Deleted ! ');
    }

    public function faild()
    {
        $id = (int)request()->route()->parameter('task');
        return response()->json('success', 'Task : ' . $id . ' Not Deleted ! ');
    }
}

