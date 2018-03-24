<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeekerExperience extends Model
{
    protected $table = 'JobSeekerExperience';

    protected $fillable = ['JobSeekerID','CompanyName','PositionName','Description','FromDate','ToDate','Salary'];


    public function user()
    {
        return $this->belongsTo('App\User', 'JobSeekerID');
    }
}
