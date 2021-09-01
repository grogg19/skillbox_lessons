<?php

namespace App\Jobs;

use App\Models\Step;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CompletedTasksReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $owner;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user = null)
    {
        $this->owner = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tasksCount = Task::when($this->owner !== null, function ($query) {
            $query->where('owner_id', $this->owner->id);
        })
            ->completed()
            ->count();

        $stepsCount = Step::when($this->owner !== null, function ($query) {
            $query->whereHas('owner', function ($query) {
                $query->where('users.id', $this->owner->id);
            });
        })
            ->completed()
            ->count();

        Log::info(($this->owner ? $this->owner->name : 'Всего') . ": Выполненных шагов: $stepsCount, Выполненных задач: $tasksCount");
    }

    public function fail($exception = null)
    {
        Log::error($exception->getMessage());
    }
}
