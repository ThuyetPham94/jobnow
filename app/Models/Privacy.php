<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    protected $table = 'Privacy';

    protected $fillable = ['Title','Description'];

}
