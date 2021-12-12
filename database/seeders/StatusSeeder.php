<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'новый']);
        Status::create(['name' => 'на тестировании']);
        Status::create(['name' => 'в работе']);
        Status::create(['name' => 'завершен']);
        Status::factory()
            ->count(6)
            ->create();
    }
}
