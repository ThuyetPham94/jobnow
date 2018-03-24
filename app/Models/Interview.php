<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $table = 'Interview';

    /*public function company() {
    	return $this->belongsTo('App\Models\CompanyProfile', 'CompanyID');
    }
*/

    protected $fillable = ['JobSeekerID', 'CompanyID', 'Title', 'Content',
        'InterviewDate', 'ContactName', 'PhoneNumber','Status','Start_time','End_time','Location','IsDeleteCompany','IsDeleteJobSeeker','IsReject'];

    public function company() {
    	return $this->belongsTo('App\Models\CompanyProfile', 'CompanyID');
    }

    public function jobSeeker() {
    	return $this->belongsTo('App\Models\JobSeeker', 'JobSeekerID');
    }

}
