<?php

use Illuminate\Database\Seeder;

class JobskillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('JobSkill')->insert([
        	'JobID' => 1,
        	'SkillID' => 1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('JobSkill')->insert([
            'JobID' => 2,
            'SkillID' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('JobSkill')->insert([
            'JobID' => 3,
            'SkillID' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
