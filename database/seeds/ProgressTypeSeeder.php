<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_progress_types')->insert([
            [
                'id'   => 1,
                'name' => 'New'
            ],
            [
                'id'   => 2,
                'name' => 'In Progress'
            ],
            [
                'id'   => 3,
                'name' => 'Done'
            ]
        ]);
    }
}
