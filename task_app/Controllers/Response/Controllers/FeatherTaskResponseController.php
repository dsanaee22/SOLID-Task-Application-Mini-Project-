<?php


namespace TaskApp\Controllers\Response\Controllers;


use Illuminate\Support\Facades\Facade;
use TaskApp\Controllers\Response\HtmlResponse\failedOpenEditForm;
use TaskApp\Controllers\Response\HtmlResponse\failedTaskAdded;
use TaskApp\Controllers\Response\JsonResponse\DeleteTaskResponse;
use TaskApp\Controllers\Response\JsonResponse\EnsureTaskIdIsValidMessage;
use TaskApp\Controllers\Response\JsonResponse\FeatherTaskResponse;

class FeatherTaskResponseController extends Facade
{
    public static function getFacadeAccessor()
    {
        $response = request()->input('client');
        $class = [
                'android' => FeatherTaskResponse::class,
                'web' => \TaskApp\Controllers\Response\HtmlResponse\FeatherTaskResponse::class,
            ][$response] ?? \TaskApp\Controllers\Response\HtmlResponse\FeatherTaskResponse::class;

        return $class;
    }
}
