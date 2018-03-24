<?php

namespace App\MOdels;

use Illuminate\Database\Eloquent\Model;

class JobActstatic extends Model
{
    protected $table = 'JobActstatic';

     protected $fillable = ['JobID', 'Like','View','Share'];
     protected $timestamp = true;

    // public function 
}
