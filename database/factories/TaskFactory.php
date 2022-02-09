<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskStatus;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(1),
            'status_id' => fn () => TaskStatus::all()->random(),
            'created_by_id' => fn () => User::all()->random(),
            'assigned_to_id' => fn () => (bool) rand(0, 1) ? null : User::all()->random(),
        ];
    }
}
