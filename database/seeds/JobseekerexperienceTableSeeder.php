<?php

use Illuminate\Database\Seeder;

class JobseekerexperienceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('JobSeekerExperience')->insert([
        	'JobSeekerID' => 1,
        	'CompanyName' => 'BDW',
        	'PositionName' => 'Leader',
        	'Description' => 'Is a leader have tâm',
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('JobSeekerExperience')->insert([
            'JobSeekerID' => 1,
            'CompanyName' => 'BKAV',
            'PositionName' => 'Leader',
            'Description' => 'Is a leader have tâm',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('JobSeekerExperience')->insert([
            'JobSeekerID' => 2,
            'CompanyName' => 'VTV',
            'PositionName' => 'Leader',
            'Description' => 'Is a leader have tâm',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
