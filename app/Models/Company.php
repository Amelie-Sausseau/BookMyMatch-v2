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

    public function events() {
        return $this->belongsToMany(Event::class, 'company_events')->withPivot('seats');
    }

    protected $with = ['user', 'events'];

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

    /**
     * Get companies events
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCompanyEvent($id)
    {
        $companyEvent = DB::select('select * from company_events where company_id = ?', [$id]);

        return $companyEvent;
    }

    /**
     * Get companies events
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCompanyEvents($id)
    {
        $companyEvent = DB::select('select * from company_events where company_id = ?', [$id], 'and event_id = ?', [$id2]);

        return $companyEvent;
    }
}
