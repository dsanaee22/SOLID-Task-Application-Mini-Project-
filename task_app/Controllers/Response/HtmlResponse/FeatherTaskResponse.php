<?php


namespace TaskApp\Controllers\Response\HtmlResponse;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Facade;
use TaskApp\Controllers\Response\HtmlResponse\failedOpenEditForm;
use TaskApp\Controllers\Response\HtmlResponse\failedTaskAdded;
use TaskApp\Controllers\Response\JsonResponse\EnsureTaskIdIsValidMessage;

class FeatherTaskResponse
{

    public function taskIdNotValid(): RedirectResponse
    {
        $id = (int)request()->route()->parameter('task');
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'Task Id : ' . $id . ' Is Not Valid !',
            ]);

    }

    public function tooManyTask(): RedirectResponse
    {
        return redirect()
            ->route('tasks.index')
            ->with('error', 'Number Of Tasks In Over That System Allowed !');
    }

    public function userBanned($second): RedirectResponse
    {
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'You Banned Because Trying To Change The CheckBox !!',
                'You Are Banned For ' . $second . ' sec '
            ]);
    }

    public function userCantManage($reason, $expire_at): RedirectResponse
    {
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'You Can Manage Your Tasks !',
                'Your Limit Expire In :' . $expire_at,
                'reason : ' . $reason
            ]);
    }

    public function userCantTamperTasks()
    {
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'You Cant Temper Tasks Bad Boy , You Will Be KickOf If Continue Like Evil!!',
            ]);
    }

    public function dataNotValid(): RedirectResponse
    {
        return redirect()
            ->route('tasks.index')
            ->withErrors([
                'Your Data Not Valid ! ',
            ]);

    }

}

