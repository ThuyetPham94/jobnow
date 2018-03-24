<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'Currency';

    protected $fillable = ['Name','Symbol','IsActive', 'Description'];

    protected $timestamp = true;
}
