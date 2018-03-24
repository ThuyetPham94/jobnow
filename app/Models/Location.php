<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'Location';

    protected $fillable = ['Name','ZipCode','IsActive','Description','CountryID'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'CountryID');
    }
    public function job()
    {
        return $this->hasOne('App\Models\Job', 'LocationID');
    }
}
