<?php

use Illuminate\Database\Seeder;

class JobActstaticTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('JobActstatic')->insert([
        	'JobID' => 1,
        	'Like' => 0,
        	'View' => 1000,
        	'Share' => 0,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('JobActstatic')->insert([
        	'JobID' => 2,
        	'Like' => 0,
        	'View' => 1200,
        	'Share' => 0,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('JobActstatic')->insert([
        	'JobID' => 3,
        	'Like' => 0,
        	'View' => 1010,
        	'Share' => 0,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
