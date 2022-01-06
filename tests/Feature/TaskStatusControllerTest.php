<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        TaskStatus::factory()->count(2)->make();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('taskStatuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('taskStatuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)->get(route('taskStatuses.edit', [$taskStatus]));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = TaskStatus::factory()->make()->only(['name']);
        $response = $this->actingAs($this->user)->post(route('taskStatuses.store'), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $factoryData);
    }

    public function testUpdate()
    {
        $taskStatus = TaskStatus::factory()->create();
        $factoryData = TaskStatus::factory()->make()->only(['name']);
        $response = $this->actingAs($this->user)->patch(route('taskStatuses.update', $taskStatus), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $factoryData);
    }

    public function testDestroy()
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('taskStatuses.destroy', [$taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
