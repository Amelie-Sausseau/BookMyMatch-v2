<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BookingController;
use App\Models\Event;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'numeric'],
            'city' => ['required', 'string', 'max:25'],
            'available_seats' => ['nullable', 'numeric'],
            'opening_hours' => ['nullable', 'string', 'max:191'],
            'image' => 'required|mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg|max:2048',
        ]);

        $fileName = $request->image->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;

        $path = Storage::disk('public')->put($filePath, file_get_contents($request->image));
        $path = Storage::disk('public')->url($path);

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'available_seats' => $request->available_seats,
            'opening_hours' => $request->opening_hours,
            'user_id' => Auth::user()->id,
            'image' => $fileName,
        ]);

        return Redirect::route('company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::getCompany($id);
        return view('company-detail', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::getCompany($id);
        return view('profile.company-edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatedCompany = Company::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'numeric'],
            'city' => ['required', 'string', 'max:25'],
            'available_seats' => ['nullable', 'numeric'],
            'opening_hours' => ['nullable', 'string', 'max:191'],
            'image' => 'nullable|mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg|max:2048',
        ]);

        if ($request->image) {
         $fileName = $request->image->getClientOriginalName();
         $filePath = 'uploads/' . $fileName;

         $path = Storage::disk('public')->put($filePath, file_get_contents($request->image));
         $path = Storage::disk('public')->url($path);

         $updatedCompany->update([
            'image' => $fileName,
        ]);
        };

        $updatedCompany->update([
            'name' => $request->name,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'available_seats' => $request->available_seats,
            'opening_hours' => $request->opening_hours,
            'user_id' => Auth::user()->id,
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
        //
    }

    /**
     * Get companies
     *
     * @return \Illuminate\Http\Response
     */
    public function getCompany()
    {
        $id = Auth::user()->id;
        $companies = DB::select('select * from companies where user_id = ?', [$id]);

        return view("dashboard", compact("companies"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEventCompany($id)
    {
        $events = Event::where('date', '>', now())->orderBy('date')->get();
        $company = Company::getCompany($id);
        return view('profile.add-booking', ['events' => $events, 'company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEventCompany(Request $request, $id)
    {
        $company = Company::getCompany($id);

        $request->validate([
            'events' => ['required'],
            'schedule_date' => ['required'],
            'seats' => ['required'],
        ]);

        $eventId = $request->input('events');
        $seats = $request->input('seats');
        $date = $request->input('schedule_date');
        $company->events()->attach($eventId, ['seats' => $seats, 'date' => $date]);

        return Redirect::route('dashboard');
    }

    /**
     * Destroy resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Request
     */
    public function destroyEventCompany(Request $request)
    {
        $companyId = $request->input('company_id');
        $company = Company::getCompany($companyId);
        $eventId = $request->input('event_id');
        $company->events()->detach($eventId);

        return Redirect::route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editEventCompany(Request $request)
    {
        $companyId = $request->input('company_id_edit');
        $eventId = $request->input('event_id_edit');
        $companyEvent = DB::table('company_events')->where('company_id', $companyId)->where('event_id', $eventId)->get();
        return view('profile.edit-booking', ['companyEvent' => $companyEvent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEventCompany(Request $request, $id)
    {
        $company = Company::getCompany($id);

        $request->validate([
            'event' => ['required'],
            'schedule_date' => ['required'],
            'seats' => ['required'],
        ]);


        $eventId = $request->input('event_id');
        $seats = $request->input('seats');
        $date = $request->input('schedule_date');
        $company->events()->updateExistingPivot($eventId, ['seats' => $seats, 'date' => $date]);

        return Redirect::route('dashboard');
    }
}
