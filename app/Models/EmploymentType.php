<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmploymentType extends Model
{
    protected $table = 'EmploymentType';

    protected $fillable = ['NameType'];

    protected $timestamp = true;

}
