<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlist extends Model
{
    protected $table = 'ShortList';

    protected $fillable = ['CategoryID', 'UserID','JobID'];

}
