<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    protected $table = 'SavedJob';

    protected $fillable = ['JobSeekerID','JobID','CreateDate'];

}
