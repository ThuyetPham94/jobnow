<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'Invite';

    protected $fillable = ['CompanyName','FirstName','LastName','Status','Email','User_id'];
   
}
