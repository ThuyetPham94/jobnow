<?php

use Illuminate\Database\Seeder;

class CompanyimageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('CompanyImage')->insert([
        	'CompanyID' => 1,
        	'ImageUrl' => 'imaga1.png',
        	'ImageTitle' => 'BDW',
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('CompanyImage')->insert([
            'CompanyID' => 1,
            'ImageUrl' => 'imaga1.png',
            'ImageTitle' => 'BDW',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
