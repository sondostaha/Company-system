<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $guarded =[];

    protected $fillable = [
        'image' , 'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Projects::class,'project_id','id');
    }
}
