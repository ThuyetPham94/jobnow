<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'Term';

    protected $fillable = ['Title','Description'];

    protected $timestamp = true;
}
