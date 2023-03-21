<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function company()
    {
        return $this->belongsTo(User::class,'company_id','id');
    }

    public function project()
    {
        return $this->belongsToMany(Projects::class,'project_id','id');
    }
    
}
