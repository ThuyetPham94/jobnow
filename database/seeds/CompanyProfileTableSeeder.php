<?php

use Illuminate\Database\Seeder;

class CompanyProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('CompanyProfile')->insert([
        	'CompanyID' => 1,
        	'Logo' => 'logo1.jpeg',
        	'Name' => 'BDW',
        	'CoverImage' => 'cover1.png',
        	'Overview' => 'company overview',
        	'WhyJoinUs' => '<h1>Why join our company ?</h1>',
        	'CompanySizeID' => 1,
        	'ContactName' => 'NTH',
        	'ContactNumber' => '08 9999 9999',
        	'Address' => '01 NTH street - Da Nang - Viet Nam',
        	'RegistrationNo' => '001952',
        	'Website' => 'bdw.com',
        	'WorkingHour' => 'Monday to Friday',
        	'DressCode' => 'comfortable',
        	'Benefit' => 'very much Benefit good',
        	'Spoken' => 'English',
        	'IsActive' => 1,
            'Latitude'=>0,
            'Longitude'=>0,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
