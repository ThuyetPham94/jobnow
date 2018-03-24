<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeekerSkill extends Model
{
    protected $table = 'JobSeekerSkill';

    protected $fillable = ['JobSeekerID','SkillID','PositionName','Description'];

    public function user()
    {
        return $this->belongsTo('App\User', 'JobSeekerID');
    }
    public function skill()
    {
        return $this->hasOne('App\Models\Skill', 'id');
    }
}
