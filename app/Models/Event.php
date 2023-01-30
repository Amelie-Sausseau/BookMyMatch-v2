<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'title'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function companies() {
        return $this->belongsToMany(Company::class, 'company_events')->withPivot('seats', 'date');
    }



}
