<?php

namespace Database\Seeders;

use App\Models\Step;
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


        Task::flushEventListeners();

        User::factory()
            ->has(Task::factory()
                ->has(Step::factory()->count(rand(1,5)), 'steps')
                ->count(2),'tasks')
            ->count(3)
            ->create();
    }
}
