<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nextEvent = Event::where('date', '>', now())->orderBy('date')->first();
        $companiesEvents = DB::table('company_events')->where('event_id', $nextEvent->id)->get();
        //$companiesList = DB::select('select * from companies where id = ?', [$companiesEvents->company_id]);
        foreach ($companiesEvents as $company) {
            $companiesList = DB::select('select * from companies where id = ?', [$company->company_id]);
        }
        return view('companies-list', ['companiesList' => $companiesList, 'nextEvent' => $nextEvent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = session()->get('company');

        $event = session()->get('event');

        $user = Auth::user()->id;

        $request->validate([
            'schedule_date' => ['required'],
            'scheduled_seats' => ['required'],
        ]);

        Booking::create([
            'user_id' => $user,
            'event_id' => $event->id,
            'company_id' => $company->id,
            'schedule_date' => $request->schedule_date,
            'scheduled_seats' => $request->scheduled_seats,
        ]);

        //$companyEvent = DB::table('company_events')->where('company_id', $company)->where('event_id', $event)->get();
        //$updatedSeats = $companyEvent->seats - $request->scheduled_seats;
        //$companyEvent->updateExistingPivot(['seats' => $updatedSeats]);

        return Redirect::route('dashboard');
    }

    /**
     * Get bookings
     *
     * @return \Illuminate\Http\Response
     */
    public function getBookings()
    {
        $user = Auth::user()->id;
        $bookings = DB::select('select * from bookings where user_id = ?', [$user]);

        return view("dashboard", ['bookings' => $bookings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        //$event = session()->get('event');
        return view('booking.edit', ['booking' => $booking]); //'event' => $event]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $company = session()->get('company');

        $event = session()->get('event');

        $user = Auth::user()->id;

        $request->validate([
            'schedule_date' => ['required'],
            'scheduled_seats' => ['required'],
        ]);

        $booking->update([
            'user_id' => $user,
            'event_id' => $event->id,
            'company_id' => $company->id,
            'schedule_date' => $request->schedule_date,
            'scheduled_seats' => $request->scheduled_seats,
        ]);


        return Redirect::route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        $this->authorize('delete', $booking);

        if (Auth::user()->id == $booking->user_id) {
            DB::delete('delete from bookings where id = ?', [$id]);

            return Redirect::route('dashboard');
        }
        else if (Auth::user()->role_id == 3) {
            DB::delete('delete from bookings where id = ?', [$id]);

            return Redirect::route('admin');
        }
        else {
            return Redirect::route('dashboard')
                ->with('message', 'Vous n\'avez pas les droits!');
        }
    }
}
