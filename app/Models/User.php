<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasUUID;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory;
    use HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'image', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function notes() {
        return $this->hasMany(Notes::class);
    }

    public function favorites() {
        return $this->belongsToMany(Company::class, 'favorites');
    }

    public function isAdmin() {
        if ($this->role_id == 3) {
            return true;
        }
    }

    public function isManager() {
        if ($this->role_id == 2) {
            return true;
        }
    }

    public function isUser() {
        if ($this->role_id == 1) {
            return true;
        }
    }

}
