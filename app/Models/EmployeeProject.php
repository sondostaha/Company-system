<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProject extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'project_id',
        'employee_id'
    ];

    public function projects()
    {
        $this->hasMany(Projects::class ,'emplyee_id','id');
    }
    public function employee()
    {
        return $this->belongsToMany(Employees::class,'project_id','id');
    }
}
