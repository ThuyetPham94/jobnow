<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $table = 'AppliedJob';

    protected $fillable = ['JobSeekerID', 'JobID'];

    protected $timestamp = true;

    public function jobs()
    {
        return $this->hasOne('App\Models/Job', 'JobID');
    }

    public function users(){
    	return $this->belongsTo('App\User', 'JobSeekerID');
    }

}
