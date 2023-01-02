<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class FileUploadController extends Controller
{
    public function getFileUploadForm()
    {
        return view('profile.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg|max:2048',
        ]);

        $fileName = $request->file->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;

        $path = Storage::disk('public')->put($filePath, file_get_contents($request->file));
        $path = Storage::disk('public')->url($path);
        Auth()->user()->update(['image'=>$fileName]);

        // Perform the database operation here

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
