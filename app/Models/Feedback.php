<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'Feedback';

    protected $fillable = ['Title','Message','User_id'];

    protected $timestamp = true;

    
}
