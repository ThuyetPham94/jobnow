<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'Category';

    protected $fillable = ['id','CompanyID', 'Name'];     
    
   public function user() {
    	return $this->belongsToMany('App\User', 'CompanyID');
    }
}
