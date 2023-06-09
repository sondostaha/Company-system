<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $guraded = [];
    protected $fillable =[
        'company_id',
        'name',
        'description',
        'document',
        'status',
        'start_date',
       ' end_date',
       'end_date'
    ];
    public function company()
    {
        return $this->belongsTo(User::class,'company_id','id');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class,'client_id','id');
    }
    public function employees()
    {
        return $this->belongsToMany(Employees::class,EmployeeProject::class,'project_id','employee_id');
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
