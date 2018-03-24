<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'Username' => 'hieunt',
            'Email' => 'tronghieudev@gmail.com',
        	'IsCompany' => 1,
        	'Password' => bcrypt('12345678'),
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'Username' => 'trungpro',
            'Email' => 'vnblues.com@gmail.com',
            'IsCompany' => 0,
            'Password' => bcrypt('12345678'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'Username' => 'admin',
            'Email' => 'admin@gmail.com',
            'IsCompany' => 2,
            'Password' => bcrypt('12345678'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
