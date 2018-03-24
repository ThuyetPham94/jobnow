<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'CompanyProfile';

    protected $fillable = ['CompanyID', 'Logo', 'Name', 'CoverImage', 'Overview', 'WhyJoinUs', 'CompanySizeID', 'ContactName', 'ContactNumber', 'Address', 'RegistrationNo', 'Website', 'WorkingHour', 'DressCode', 'Benefit', 'Spoken', 'IsActive','Latitude','Longitude','IsPremium','FaceBookPage','EA_Reg','EA_No'];

    protected $timestamp = true;

    public function users() {
    	return $this->belongsTo('App\User', 'CompanyID');
    }
    public function companySize() {
    	return $this->belongsTo('App\Models\CompanySize', 'CompanySizeID');
    }
    public function companyImage() {
    	return $this->hasMany('App\Models\CompanyImage', 'CompanyID');
    }
    public function industry() {
    	return $this->belongsToMany('App\Models\Industry', 'CompanyIndustry', 'CompanyID', 'IndustryID')->withTimestamps();
    }
    public function review() {
        return $this->hasMany('App\Models\CompanyReview', 'CompanyID');
    }
    public function job() {
        return $this->hasMany('App\Models\Job', 'CompanyID');
    }

    public function interview() {
        return $this->hasMany('App\Models\Interview', 'CompanyID');
    }

    public static function boot()
    {
        parent::boot();

        // static::creating(function($user){
        //     $user->password = 'testpass';
        //     $user->avatar = $user->username . '.jpg';
        // });

        // static::created(function($user) {
        //     $user->profile->save();
        // });

        static::deleting(function($company){
            $company->industry()->detach();
            $company->companyImage()->delete();
            $company->review()->delete();
            $company->interview()->delete();
            // $company->job()->delete();
        });
    }
}
