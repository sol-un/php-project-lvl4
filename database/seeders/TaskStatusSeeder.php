<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::create(['name' => 'новый']);
        TaskStatus::create(['name' => 'на тестировании']);
        TaskStatus::create(['name' => 'в работе']);
        TaskStatus::create(['name' => 'завершен']);
    }
}
