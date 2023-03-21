<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $guraded = [];

    public function company()
    {
        return $this->belongsTo(User::class,'company_id','id');
    }

    public function clients()
    {
        return $this->hasMany(Clients::class,'project_id','id');
    }
    public function employees()
    {
        return $this->hasMany(Employees::class,'project_id','id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class,'project_id','id');
    }

    public function images()
    {
        return $this->hasMany(Images::class,'project_id','id');
    }
    public function pending()
    {
        return $this->belongsTo(ProjectPending_reason::class ,'project_id','id');
    }
}
