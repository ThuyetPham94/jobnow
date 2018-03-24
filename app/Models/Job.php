<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'Job';

    protected $fillable = ['CompanyID', 'IndustryID','Title','Position','Level','YearOfExperience','LocationID','FromSalary','ToSalary','CurrencyID','IsDisplaySalary','Description','Requirement','CreateDate','IsActive', 'Latitude', 'Longitude','Start_date','End_date','JobLevelID','Location','SkillList','ExperienceID','DateExprire','EmploymentID','WorkingHours'];

    public function company() {
    	return $this->belongsTo('App\Models\CompanyProfile', 'CompanyID');
    }
    public function location() {
    	return $this->belongsTo('App\Models\Location', 'LocationID');
    }
    public function currency() {
    	return $this->belongsTo('App\Models\Currency', 'CurrencyID');
    }
    public function appliedJob() {
        return $this->belongsToMany('App\User', 'AppliedJob', 'JobID', 'JobSeekerID')->withTimestamps();
    }
    public function savedJob() {
        return $this->belongsToMany('App\User', 'SavedJob', 'JobID', 'JobSeekerID')->withTimestamps();
    }
    public function skill() {
        return $this->belongsToMany('App\Models\Skill', 'JobSkill', 'JobID', 'SkillID')->withTimestamps();
    }
    public function industry() {
        return $this->belongsTo('App\Models\Industry', 'IndustryID');
    }
    public function jobsactstatic() {
        return $this->hasOne('App\Models\JobActstatic', 'JobID');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($job){
            $job->jobsactstatic()->delete();
            $job->appliedJob()->detach();
            $job->savedJob()->detach();
            $job->skill()->detach();
            
        });
    }

}
