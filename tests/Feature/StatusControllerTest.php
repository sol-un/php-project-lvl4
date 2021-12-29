<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use App\Models\User;

class StatusControllerTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        Status::factory()->count(2)->make();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('statuses.create'));
        $response->assertOk();
    }

    public function testEdit()
    {
        $status = Status::factory()->create();
        $response = $this->actingAs($this->user)->get(route('statuses.edit', [$status]));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = Status::factory()->make()->only(['name']);
        $response = $this->actingAs($this->user)->post(route('statuses.store'), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('statuses', $factoryData);
    }

    public function testUpdate()
    {
        $status = Status::factory()->create();
        $factoryData = Status::factory()->make()->only(['name']);
        $response = $this->actingAs($this->user)->patch(route('statuses.update', $status), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('statuses', $factoryData);
    }

    public function testDestroy()
    {
        $status = Status::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('statuses.destroy', [$status]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('statuses', ['id' => $status->id]);
    }
}
