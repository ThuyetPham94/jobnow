<?php

use Illuminate\Database\Seeder;

class IndustryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Industry')->insert([
        	'Name' => 'IT',
        	'IsActive' => 1,
        	'Description' => 'Good Job',
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Industry')->insert([
            'Name' => 'Phần Cứng',
            'IsActive' => 1,
            'Description' => 'Good Job ahihi',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('Industry')->insert([
            'Name' => 'Kế Toán',
            'IsActive' => 1,
            'Description' => 'Good Job ahihi',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
