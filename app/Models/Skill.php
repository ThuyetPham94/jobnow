<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'Skill';

    protected $fillable = ['Name','IndustryID','IsActive','Description'];

    protected $timestamp = true;

    public function jobseekerskill()
    {
        return $this->belongsToMany('App\Models\Skill', 'JobSeekerSkill' , 'SkillID', 'JobSeekerID');
    }
    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'IndustryID');
    }
}
