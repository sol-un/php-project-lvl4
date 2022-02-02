<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;

class LabelControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        User::factory()->count(10)->create();
        TaskStatus::factory()->count(5)->create();
        Task::factory()->count(10)->create();
        Label::factory()->count(5)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $label = label::factory()->create();
        $response = $this->actingAs($this->user)->get(route('labels.edit', [$label]));
        $response->assertOk();
        $response->assertSee($label['name']);
    }

    public function testStore()
    {
        $factoryData = label::factory()
            ->make(['name' => 'mytestlabel'])
            ->only(['name', 'description']);

        $response = $this->actingAs($this->user)->post(route('labels.store'), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $factoryData);

        $response = $this->get(route('labels.index'));
        $response->assertSee($factoryData['name']);
    }

    public function testUpdate()
    {
        $label = label::factory()->create();
        $factoryData = label::factory()
        ->make(['name' => 'mytestlabel'])
        ->only(['name', 'description']);

        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $factoryData);

        $response = $this->get(route('labels.index'));
        $response->assertSee($factoryData['name']);
    }

    public function testDestroy()
    {
        $label = label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', [$label]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
