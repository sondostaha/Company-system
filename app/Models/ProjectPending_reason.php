<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPending_reason extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function projects()
    {
        return $this->hasMany(Projects::class ,'project_id','id');
    } 
}
