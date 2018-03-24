<?php

use Illuminate\Database\Seeder;

class SavejobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('SavedJob')->insert([
        	'JobSeekerID' => 1,
        	'JobID' => 1,
            'CreateDate' => \Carbon\Carbon::now(),
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('SavedJob')->insert([
            'JobSeekerID' => 2,
            'JobID' => 2,
            'CreateDate' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
