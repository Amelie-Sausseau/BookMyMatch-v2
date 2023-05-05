<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $bookings = Booking::all();
        $companies = Company::all();
        $users = User::with('role')->get();

        return view('admin', [
            'events' => $events,
            'bookings' => $bookings,
            'companies' => $companies,
            'users' => $users
        ]);
    }
}
