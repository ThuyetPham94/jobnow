<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    protected $table = 'JobSeeker';

    protected $fillable = ['user_id','Avatar','FullName','BirthDay','Gender','PhoneNumber','CountryID','PostalCode','CurriculumVitae','Description','IsActive'];

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function experience() {
    	return $this->hasMany('App\Models\JobSeekerExperience', 'JobSeekerID');
    }
    public function country() {
        return $this->belongsTo('App\Models\Country', 'CountryID');
    }
    public function interview() {
        return $this->hasMany('App\Models\Interview', 'JobSeekerID');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function($job){
            $job->experience()->delete();
            $job->interview()->delete();
        });
    }
}
