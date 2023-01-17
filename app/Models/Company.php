<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'opening_hours', 'available_seats', 'address', 'city', 'postal_code', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function favorites() {
        return $this->belongsToMany(User::class, 'favorites');
    }

    protected $with = ['user'];

    /**
     * Get a company
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getCompany($id) {
        $company = Company::findOrFail($id);
        return $company;
    }
}
