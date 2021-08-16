<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test', function (){
    /** @var $this \Illuminate\Console\Command */

    $subject = $this->ask('Введите тему письма');

    $name = $this->call('app:say_hello', [
        'users' => [1,2],
        '--subject' => $subject,
        '--class' => true
    ]);

    //$this->info($name);

});
