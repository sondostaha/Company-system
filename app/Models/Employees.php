<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employees extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];
   
    public function company()
    {
        return $this->belongsTo(User::class,'company_id','id');
    }
    public function projects()
    {
        return $this->hasMany(Projects::class,'project_id','id');
    }
    
    public function position()
    {
        return $this->belongsTo(Position::class,'position_id','id');
    }
    

}
