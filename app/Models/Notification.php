<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'Notification';

    protected $fillable = ['CompanyID','Title','Content','Status','CreateDate','JobSeekerID','KeyScreen','JobID','isCompany'];
   
}
