<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Location')->insert([
        	'Name' => 'Hà Nội',
        	'ZipCode' => '100000',
        	'IsActive' => 1,
        	'Description' => 'HN is capital for Viet Nam',
            'CountryID'=>1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Location')->insert([
            'Name' => 'Hồ Chí Minh',
            'ZipCode' => '400000',
            'IsActive' => 1,
            'CountryID'=>1,
            'Description' => 'HN is capital for Viet Nam',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Location')->insert([
            'Name' => 'Đà Nẵng',
            'ZipCode' => '500000',
            'IsActive' => 1,
            'CountryID'=>1,
            'Description' => 'HN is capital for Viet Nam',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Location')->insert([
            'Name' => 'Pnompenh',
            'ZipCode' => '500000',
            'IsActive' => 1,
            'CountryID'=>2,
            'Description' => 'HN is capital for Viet Nam',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
