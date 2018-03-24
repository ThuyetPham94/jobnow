<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'Industry';

    protected $fillable = ['Name','IsActive','Description'];

    protected $timestamp = true;

    public function skill()
    {
        return $this->hasMany('App\Models\Skill', 'IndustryId');
    }
}
