<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'Contact';

    protected $fillable = ['Name','Email','PhoneNumber', 'Subject', 'Content'];

    protected $timestamp = true;
}
