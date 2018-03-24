<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(UsersTableSeeder::class);
        // $this->call(CountryTableSeeder::class);
        // $this->call(LocationTableSeeder::class);
        // $this->call(CurrencyTableSeeder::class);
        // $this->call(IndustryTableSeeder::class);
        // $this->call(CompanysizeTableSeeder::class);
        // $this->call(SkillTableSeeder::class);
        // $this->call(JobseekerTableSeeder::class);
        // $this->call(JobseekerexperienceTableSeeder::class);
        // $this->call(JobseekerskillTableSeeder::class);
        // $this->call(CompanyProfileTableSeeder::class);
        // $this->call(CompanyindustryTableSeeder::class);
        // $this->call(CompanyimageTableSeeder::class);
        // $this->call(CompanyreviewTableSeeder::class);
        // $this->call(JobTableSeeder::class);
        // $this->call(JobskillTableSeeder::class);
        // $this->call(SavejobTableSeeder::class);
        // $this->call(AppliedjobTableSeeder::class);
        // $this->call(NotificationTableSeeder::class);
        // $this->call(JobActstaticTableSeeder::class);
        // $this->call(InterviewTableSeeder::class);
        Model::unguard();

        $this->call('ConferSeeder');        
    }
}
