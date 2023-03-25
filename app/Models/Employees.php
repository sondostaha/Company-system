<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
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
