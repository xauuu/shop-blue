<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'name',
        'avatar'
    ];
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';

    public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
    public function hasAnyRoles($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
}
