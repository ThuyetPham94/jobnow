<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    protected $table = 'CompanyReview';

    protected $fillable = ['JobSeekerID','CompanyID','OverallRating','Title','Review'];

    protected $timestamp = true;

    public function jobseeker() {
    	return $this->belongsTo('App\Models\JobSeeker', 'JobSeekerID');
    }
}
