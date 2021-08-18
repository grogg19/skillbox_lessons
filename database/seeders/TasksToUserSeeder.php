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

        Task::factory(5)->create([
            'owner_id' => $user
        ])->each(function (Task $task) {
             $task->steps()->saveMany(Step::factory(rand(1,5))->make());
        });
    }
}
