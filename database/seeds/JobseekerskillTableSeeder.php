<?php

use Illuminate\Database\Seeder;

class JobseekerskillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('JobSeekerSkill')->insert([
        	'JobSeekerID' => 1,
        	'SkillID' => 1,
        	'PositionName' => 'Leader',
        	'Description' => 'Is a seeker pro',
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
         DB::table('JobSeekerSkill')->insert([
            'JobSeekerID' => 2,
            'SkillID' => 2,
            'PositionName' => 'Leader',
            'Description' => 'Is a seeker pro',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
