<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:say_hello
    {users* : Пользователи}
    {--subject=Hello : Заголовок письма}
    {--c|class : Преобразовать в имя класса }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить привет пользователю';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::findOrFail($this->argument('users'));

        $subject = $this->option('subject');

        if ($this->option('class')) {
            $subject = Str::studly($subject);
        }

        $users->map->notify(new \App\Notifications\SayHello($subject));
    }
}
