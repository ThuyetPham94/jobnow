<?php

use Illuminate\Database\Seeder;

class AppliedjobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('AppliedJob')->insert([
        	'JobSeekerID' => 1,
        	'JobID' => 1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('AppliedJob')->insert([
            'JobSeekerID' => 2,
            'JobID' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
