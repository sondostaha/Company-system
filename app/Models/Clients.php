<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $fillanle=[
        'first_name'
    ];
    public function company()
    {
        return $this->belongsTo(User::class,'company_id','id');
    }

   
    public function projects()
    {
        return $this->hasMany(Projects::class,'project_id','id');
    }
    
}
