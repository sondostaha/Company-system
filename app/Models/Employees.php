<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employees extends Authenticatable implements JWTSubject
{
    use HasApiTokens , HasFactory, Notifiable;

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
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }  

}
