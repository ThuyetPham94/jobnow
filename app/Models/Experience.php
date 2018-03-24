<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'Experience';

    protected $fillable = ['Name'];

    protected $timestamp = true;

}
