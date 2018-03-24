<?php

use Illuminate\Database\Seeder;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Skill')->insert([
        	'Name' => 'PHP',
        	'IndustryID' => 1,
        	'IsActive' => 1,
        	'Description' => 'Good Job',
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Skill')->insert([
            'Name' => 'ASP',
            'IndustryID' => 2,
            'IsActive' => 1,
            'Description' => 'Good Job',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Skill')->insert([
            'Name' => 'C++',
            'IndustryID' => 3,
            'IsActive' => 1,
            'Description' => 'Good Job',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
