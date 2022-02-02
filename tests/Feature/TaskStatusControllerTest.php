<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Task;

class TaskStatusControllerTest extends TestCase
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
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', [$taskStatus]));
        $response->assertOk();
        $response->assertSee($taskStatus['name']);
    }

    public function testStore()
    {
        $factoryData = TaskStatus::factory()
            ->make(['name' => 'myteststatus'])
            ->only(['name']);

        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $factoryData);

        $response = $this->get(route('task_statuses.index'));
        $response->assertSee($factoryData['name']);
    }

    public function testUpdate()
    {
        $taskStatus = TaskStatus::factory()->create();
        $factoryData = TaskStatus::factory()
        ->make(['name' => 'myteststatus'])
        ->only(['name']);

        $response = $this->actingAs($this->user)->patch(route('task_statuses.update', $taskStatus), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $factoryData);

        $response = $this->get(route('task_statuses.index'));
        $response->assertSee($factoryData['name']);
    }

    public function testDestroy()
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', [$taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
