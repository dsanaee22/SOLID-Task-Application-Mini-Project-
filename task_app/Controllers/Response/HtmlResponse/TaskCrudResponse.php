<?php


namespace TaskApp\Controllers\Response\HtmlResponse;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Facade;


class TaskCrudResponse
{

    public function successCreate(): RedirectResponse
    {
        return redirect()
            ->route('tasks.index')
            ->with('message', 'Task Has Been successfully Added !');
    }

    public function failedCreate(): RedirectResponse
    {
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'Task Was Not Created !',
            ]);

    }

    public function successUpdate(): RedirectResponse
    {
        $id = (int)request()->route()->parameter('task');
        return redirect()
            ->route('tasks.index')
            ->with('message', 'Task : ' . $id . ' Successfully Updated ! ',);
    }

    public function failedUpdate(): RedirectResponse
    {
        $id = (int)request()->route()->parameter('task');
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'Task : ' . $id . ' Not Updated !',
            ]);
    }

    public function successDelete(): RedirectResponse
    {
        $id = (int)request()->route()->parameter('task');
        return redirect()
            ->route('tasks.index')
            ->with('message', 'Task : ' . $id . ' Successfully Deleted ! ',);
    }

    public function failedDelete(): RedirectResponse
    {
        $id = (int)request()->route()->parameter('task');
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'Task : ' . $id . ' Not Deleted !',
            ]);
    }

    public function showCreateForm()
    {
        return view('Task::create');
    }


    public function showEditForm($task)
    {
        return view('Task::edit', ['task' => $task]);
    }

    public function failedShowEditForm()
    {
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'Edit Form Can Not Shown !',
            ]);

    }
}

