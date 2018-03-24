<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyIndustry extends Model
{
    protected $table = 'CompanyIndustry';

    protected $fillable = ['CompanyID', 'IndustryID'];

    protected $timestamp = true;
}
