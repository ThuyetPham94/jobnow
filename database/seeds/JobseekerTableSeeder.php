<?php

use Illuminate\Database\Seeder;

class JobseekerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('JobSeeker')->insert([
        	'user_id' => 1,
        	'Avatar' => 'avt.jpg',
        	'FullName' => 'Nguyễn Trọng Hiếu',
        	'Gender' => 3,
        	'PhoneNumber' => '0981945175',
            'CountryID' => 1,
        	'PostalCode' => 123,
        	'CurriculumVitae' => 'None CV',
        	'Description' => 'Is a seeker pro',
        	'IsActive' => 1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('JobSeeker')->insert([
            'user_id' => 2,
            'Avatar' => 'avt.jpg',
            'FullName' => 'Trung Đẹp Trai',
            'Gender' => 1,
            'PhoneNumber' => '0981945175',
            'CountryID' => 1,
            'PostalCode' => 123,
            'CurriculumVitae' => 'None CV',
            'Description' => 'Is a seeker pro',
            'IsActive' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
