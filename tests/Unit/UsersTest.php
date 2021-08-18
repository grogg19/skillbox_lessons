<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAUserCanHaveATasks()
    {
        $user = User::factory()->create();

        $attributes = Task::factory()->raw(['owner_id' => $user]);

        $user->tasks()->create($attributes);

        $this->assertEquals($attributes['title'], $user->tasks->first()->title);
    }

    public function testUserCanHaveACompany()
    {
        $user = User::factory()->create();

        $user->company()->create(['name' => 'Skillbox']);

        $this->assertEquals('Skillbox', $user->company->name);
    }
}
