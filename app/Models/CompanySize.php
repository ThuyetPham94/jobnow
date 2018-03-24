<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySize extends Model
{
    protected $table = 'CompanySize';

    protected $fillable = ['Name','IsActive','Description'];

    protected $timestamp = true;
}
