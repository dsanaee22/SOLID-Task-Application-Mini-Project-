<?php


namespace TaskApp\Database\Factory;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use TaskApp\Models\Task;

class TaskFactory extends Factory
{

    protected $model = Task::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(100),
            'state' => Arr::random([1, 2, 3, 4, 5])
//            'expired_at' => $this->faker->dateTime
        ];
    }

    public function unValidTask()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => '',
            ];
        });
    }

    public function withSameUser($user_id)
    {
        return $this->state([
            'user_id' => $user_id,
        ]);
    }
}
