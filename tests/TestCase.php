<?php

namespace Tests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;
use TaskApp\Database\Factory\TempTagFactory;
use TaskApp\Database\Test\MigrationForTest;
use TaskApp\Models\Task;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        MigrationForTest::dropTaskTable();
        MigrationForTest::dropTempTagTable();
        MigrationForTest::createTaskTable();
        MigrationForTest::createTempTagTable();
        $this->login($id = 1);
    }

    public function tearDown(): void
    {
        MigrationForTest::dropTaskTable();
        MigrationForTest::dropTempTagTable();
        parent::tearDown();
    }


    protected function login(int $ID)
    {
        $user = new User();
        $user->id = $ID;

        $this->actingAs($user);
    }

    protected function taskData()
    {
        $data = Task::factory()->make()->toArray();
        unset($data['user_id']);
        return $data;
    }

    protected function createTask($data)
    {
        $this->post(route('task.store'), $data);
    }

    protected function updateTask($data, $task_id)
    {
        $this->put(route('task.update', ['task' => $task_id]), $data);
    }

}
