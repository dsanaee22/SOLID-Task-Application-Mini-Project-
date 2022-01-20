<?php


namespace TaskApp\Controllers\Response\JsonResponse;


use Illuminate\Http\JsonResponse;

class TaskCrudResponse
{

    public function successCreate(): JsonResponse
    {
        return response()->json('message', 'Task Has Been successfully Added !');
    }

    public function failedCreate(): JsonResponse
    {
        return response()->json('error', 'Task Was Not Created !');
    }

    public function successUpdate(): JsonResponse
    {
        $id = (int)request()->route()->parameter('task');
        return response()->json('message', 'Task : ' . $id . ' Successfully Updated ! ');
    }

    public function failedUpdate(): JsonResponse
    {
        $id = (int)request()->route()->parameter('task');
        return response()->json('error', 'Task : ' . $id . ' Not Updated !');
    }

    public function successDelete(): JsonResponse
    {
        $id = (int)request()->route()->parameter('task');
        return response()->json('message', 'Task : ' . $id . ' Successfully Deleted !');
    }

    public function failedDelete(): JsonResponse
    {
        $id = (int)request()->route()->parameter('task');
        return response()->json('error', 'Task : ' . $id . ' Not Deleted !');
    }

    public function showCreateForm()
    {
        return view('Task::create');
    }


    public function showEditForm($task)
    {
        return response()->json(['data' => $task]);
    }

    public function failedShowEditForm()
    {
        return response()->json('error', 'Edit Form Can Not Shown !');
    }
}

