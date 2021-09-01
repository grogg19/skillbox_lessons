<?php

namespace Database\Seeders;

use App\Models\Step;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TasksToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory([
            'name' => 'Anton Devyatov',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('12345678')
        ])->create();

        $tags = Tag::factory()->count(10)->create();

        Task::flushEventListeners();

        User::factory()
            ->has(Task::factory()
                ->has(Step::factory()->count(rand(1,5)), 'steps')
                ->afterCreating(function (Task $task) use ($tags) {
                    $task->tags()->attach(
                        $tags
                            ->shuffle()
                            ->take(rand(1,4))
                            ->pluck('id')
                    );
                })
                ->count(20),'tasks')
            ->count(3)
            ->create();
    }
}
