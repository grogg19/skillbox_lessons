<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::ucfirst((string) $this->faker->words(3, true)),
            'body' => $this->faker->sentence(),
            'owner_id' => User::factory(),
            'type' => $this->faker->randomElement(['new', 'old', 'fast']),
        ];
    }
}
