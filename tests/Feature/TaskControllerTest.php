<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class TaskControllerTest extends TestCase
{
    private User $user;

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

    public function testShow()
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task));
        $response->assertOk();
        $response->assertSee([$task['name'], $task['description']]);
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
        $response->assertSee([$task['name'], $task['description']]);
    }

    public function testStore()
    {
        $factoryData = Task::factory()
            ->make(['name' => 'mytesttask'])
            ->only(['name', 'description', 'status_id']);

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $factoryData);

        $response = $this->get(route('tasks.index'));
        $response->assertSee($factoryData['name']);
    }

    public function testUpdate()
    {
        $task = Task::factory()->create();
        $factoryData = Task::factory()
        ->make(['name' => 'mytesttask'])
        ->only(['name', 'description', 'status_id']);

        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $factoryData);

        $response = $this->get(route('tasks.index'));
        $response->assertSee($factoryData['name']);
    }

    public function testDestroy()
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', [$task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
