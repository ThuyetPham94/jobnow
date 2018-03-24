<?php

use Illuminate\Database\Seeder;

class InterviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Interview')->insert([
        	'JobSeekerID' => 2,
        	'CompanyID' => 1,
        	'Title' => "Mời phỏng vấn",
        	'Content' => 'HN is capital for Viet Nam',
            'InterviewDate'=>\Carbon\Carbon::now(),
            'ContactName'=>"Hoàng Thùy Linh",
            'PhoneNumber'=>"0987654321",
            'Status'=>1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
