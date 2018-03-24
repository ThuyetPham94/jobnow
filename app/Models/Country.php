<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'Country';

    protected $fillable = ['Name','PostalCode','IsActive','Description'];

    protected $timestamp = true;

    public function location()
    {
        return $this->hasMany('App\Models\Location', 'CountryID');
    }
}
