<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Currency')->insert([
        	'Name' => 'Viet Nam',
        	'Symbol' => 'VND',
        	'IsActive' => 1,
        	'Description' => 'None Description',
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Currency')->insert([
            'Name' => 'Dola',
            'Symbol' => 'USD',
            'IsActive' => 1,
            'Description' => 'None Description',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
