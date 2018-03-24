<?php

use Illuminate\Database\Seeder;

class CompanysizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('CompanySize')->insert([
            'Name' => '1-50',
            'Description' => 'From 1 to 50 member',
            'IsActive' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('CompanySize')->insert([
        	'Name' => '100-499',
        	'Description' => 'From 100 to 499 member',
        	'IsActive' => 1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        
    }
}
