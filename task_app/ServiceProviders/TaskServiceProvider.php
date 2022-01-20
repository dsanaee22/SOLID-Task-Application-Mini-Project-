<?php

namespace TaskApp\ServiceProviders;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use TaskApp\Behaviors\Protection\auth;
use TaskApp\Behaviors\Protection\PreventBannedUserToManagement;
use TaskApp\Classes\StoreTempTag;
use TaskApp\Models\Task;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(base_path('task_app/config.php'), 'taskConfig');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
//        TaskList::expireCache();

        $this->protection();

        StoreTempTag::install();

        User::resolveRelationUsing('tasks', function () {
            return $this->hasMany(Task::class);
        });

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
