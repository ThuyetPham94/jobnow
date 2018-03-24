<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;    
    const ADMIN = 2;
    const COMPANY = 1;
    const SEEKER = 0;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Username', 'Email', 'Password', 'IsCompany','CreditNumber','IsTrial'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['Password', 'remember_token'];

    public function getAuthPassword() {
        return $this->Password;
    }

    // public function setPasswordAttribute($password)
    // {
    //    $this->Password = $password;
    // }
    public function setPasswordAttribute($password)
    {
        $this->attributes['Password'] = $password;
    }

    // relationship seeker
    public function jobSeeker() {
        return $this->hasOne('App\Models\JobSeeker', 'user_id');
    }

    public function companyProfile() {
        return $this->hasOne('App\Models\CompanyProfile', 'CompanyID');
    }
    public function companyImage() {
        return $this->hasMany('App\Models\CompanyImage', 'CompanyID');
    }
    public function job(){
        return $this->hasMany('App\Models\Job', 'CompanyID');
    }
    public function experience()
    {
        return $this->hasMany('App\Models\JobSeekerExperience', 'JobSeekerID');
    }
    public function jobseekerskill()
    {
        return $this->belongsToMany('App\Models\Skill', 'JobSeekerSkill' , 'JobSeekerID', 'SkillID');
    }
    public function savedJob() {
        return $this->belongsToMany('App\Models\Job', 'SavedJob', 'JobSeekerID', 'JobID')->withPivot('CreateDate')->withTimestamps();
    }
    public function appliedJob() {
        return $this->belongsToMany('App\Models\Job', 'AppliedJob', 'JobSeekerID', 'JobID')->withTimestamps();
    }
    // public function ListInterview() {
    //     return $this->hasMany('App\Models\Interview', 'JobSeekerID');
    // }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($user){
            $user->jobSeeker()->delete();
            $user->companyProfile()->delete();
            $user->companyImage()->delete();
            $user->job()->delete();
            $user->experience()->delete();
            $user->jobseekerskill()->detach();
            $user->savedJob()->detach();
            $user->appliedJob()->detach();
        });
    }
}
