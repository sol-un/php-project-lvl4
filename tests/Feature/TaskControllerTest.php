<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        User::factory()->count(10)->create();
        TaskStatus::factory()->count(5)->create();
        Task::factory()->count(10)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $task = Task::factory()->create();
        $response = $this->actingAs($this->user)->get(route('tasks.edit', [$task]));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = Task::factory()->make()->only(['name', 'description', 'status_id']);
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $factoryData);
    }

    public function testUpdate()
    {
        $task = Task::factory()->create();
        $factoryData = Task::factory()->make()->only(['name', 'description', 'status_id']);
        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $factoryData);
    }

    public function testDestroy()
    {
        $task = Task::factory()->create();

        // $task->creator()->associate($this->user);
        // $response = $this->actingAs($this->user)->delete(route('tasks.destroy', [$task]));

        $response = $this->actingAs($task->creator)->delete(route('tasks.destroy', [$task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
