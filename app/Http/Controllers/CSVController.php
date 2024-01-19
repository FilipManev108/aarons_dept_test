<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\UploadParsedCSV;
use Illuminate\Support\Facades\Storage;

class CSVController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shifts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $file = $request->file('csv');
        $path = Storage::disk('public')->put('csv', $file);

        UploadParsedCSV::dispatch($path);
        dump('done');
        return redirect()->route('employees.home')->with('success', 'good job!');
    }
}
