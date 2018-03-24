<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Country')->insert([
        	'Name' => 'Viet Nam',
        	'PostalCode' => '00123',
        	'IsActive' => 1,
        	'Description' => 'Viet Nam is country beautiful',
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Country')->insert([
            'Name' => 'Campuchia',
            'PostalCode' => '345',
            'IsActive' => 1,
            'Description' => 'Viet Nam is country beautiful',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Country')->insert([
            'Name' => 'USA',
            'PostalCode' => '234',
            'IsActive' => 1,
            'Description' => 'Viet Nam is country beautiful',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Country')->insert([
            'Name' => 'Thanland',
            'PostalCode' => '567',
            'IsActive' => 1,
            'Description' => 'Viet Nam is country beautiful',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
