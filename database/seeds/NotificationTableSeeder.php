<?php

use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Notification')->insert([
        	'Title' => 'Recruitment new',
        	'Content' => 'Recruitment 500 staff',
        	'MembershipID' => 1,
        	'Status' => 1,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
