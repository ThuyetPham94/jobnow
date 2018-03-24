<?php

use Illuminate\Database\Seeder;

class CompanyindustryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('CompanyIndustry')->insert([
        	'CompanyID' => 1,
        	'IndustryID' => 1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
