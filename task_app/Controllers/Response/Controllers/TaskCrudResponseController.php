<?php


namespace TaskApp\Controllers\Response\Controllers;


use Illuminate\Support\Facades\Facade;
use TaskApp\Controllers\Response\HtmlResponse\failedOpenEditForm;
use TaskApp\Controllers\Response\HtmlResponse\failedTaskAdded;
use TaskApp\Controllers\Response\JsonResponse\DeleteTaskResponse;
use TaskApp\Controllers\Response\JsonResponse\EnsureTaskIdIsValidMessage;
use TaskApp\Controllers\Response\JsonResponse\TaskCrudResponse;
use TaskApp\Controllers\Response\JsonResponse\UpdateTaskResponse;

class TaskCrudResponseController extends Facade
{
    public static function getFacadeAccessor()
    {
        $response = request()->input('client');
        $class = [
                'android' => TaskCrudResponse::class,
                'web' => \TaskApp\Controllers\Response\HtmlResponse\TaskCrudResponse::class,
            ][$response] ?? \TaskApp\Controllers\Response\HtmlResponse\TaskCrudResponse::class;

        return $class;
    }
}
