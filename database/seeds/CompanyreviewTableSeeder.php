<?php

use Illuminate\Database\Seeder;

class CompanyreviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('CompanyReview')->insert([
        	'JobSeekerID' => 1,
        	'CompanyID' => 1,
        	'OverallRating' => 5,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('CompanyReview')->insert([
            'JobSeekerID' => 2,
            'CompanyID' => 1,
            'OverallRating' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
