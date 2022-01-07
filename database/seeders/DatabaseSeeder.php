<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TaskStatusSeeder::class,
            TaskSeeder::class,
            LabelSeeder::class,
        ]);

        $labels = Label::all();
        $tasks = Task::all();

        $tasks->each(function ($task) use ($labels) {
            $task->labels()->attach(
                $labels->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
