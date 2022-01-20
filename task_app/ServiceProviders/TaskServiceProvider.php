<?php

namespace TaskApp\ServiceProviders;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use TaskApp\Behaviors\Protection\auth;
use TaskApp\Behaviors\Protection\PreventBannedUserToManagement;
use TaskApp\Classes\StoreTempTag;
use TaskApp\Models\Task;
use TaskApp\Widgets\TaskList;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        User::resolveRelationUsing('tasks', function () {
            return $this->hasMany(Task::class);
        });

        $this->mergeConfigFrom(base_path('task_app/config.php'), 'taskConfig');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        $this->protection();

        StoreTempTag::install();

        TaskList::expireCache();

        Route::middleware('web')
            ->group(base_path('task_app/Routes/routes.php'));

        $this->loadMigrationsFrom([
            base_path('task_app/Database/Migrations')
        ]);

        $this->loadViewsFrom(base_path('task_app/Views/'), 'Task');
    }

    private function protection(): void
    {
        auth::install();

        PreventBannedUserToManagement::install();
    }
}
