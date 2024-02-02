<?php

namespace App\Models;
use App\Models\Role;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'matricule',
        'email',
        'phone',
        'password',
        'role_id',
    ];
     // Define the relationship to the Role model, in order to easily retrieve user role and avoid long queries
     public function role()
     {
         return $this->belongsTo(Role::class);
     }
     // this is used to generate a default role for new users
     protected static function boot()
    {
    parent::boot();

    static::creating(function ($user) {
        if (!$user->role_id) {
            // Find the default role
            $defaultRole = Role::where('name', 'user')->first();

            // Set the default role
            $user->role_id = $defaultRole->id;
        }
    });
    }
    
    // check if current user has role admin
    public function isAdmin()
    {
    return $this->role->name === 'admin'; 
    }

    // Implementing methods from Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id'; 
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
