<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftCreateRequest;
use App\Models\User;
use App\Models\Shift;
use App\Models\Status;
use App\Models\Company;
use App\Models\ShiftType;
use Illuminate\Http\Request;
use App\Http\Requests\ShiftEditRequest;

class ShiftController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $shifts = Shift::with('user', 'company', 'status', 'shiftType')
            ->when($request->total_pay != null && is_numeric($request->total_pay), function ($query) use ($request) {
                return $query->where('total_pay', '>=', $request->total_pay);
            })->paginate(10)->withQueryString();

            // dd($shifts);
        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();
        $shiftTypes = ShiftType::all();
        $users = User::all();
        $companies = Company::all();

        return view('shifts.create', compact('users', 'statuses', 'shiftTypes', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftCreateRequest $request)
    {
        $shift = Shift::create([
            'hours' => $request->hours,
            'rate_per_hour' => $request->rate_per_hour,
            'total_pay' => (int) ($request->hours * $request->rate_per_hour),
            'taxable' => $request->taxable,
            'paid_at' => $request->status == 1 ? now() : null,
            'status_id' => $request->status,
            'shift_type_id' => $request->shift_type,
            'user_id' => $request->user,
            'company_id' => $request->company,
            'date' => $request->date,
        ]);

        if($shift->exists)
            return redirect()->route('shifts.index')->with('success', 'Shift has been updated successfully!');
    
        return redirect()->route('shifts.index')->with('error', 'Something went wrong, try again.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        $statuses = Status::all();
        $shiftTypes = ShiftType::all();
        $users = User::all();
        $companies = Company::all();

        return view('shifts.edit', compact('shift', 'users', 'statuses', 'shiftTypes', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftEditRequest $request, Shift $shift)
    {
        $shift->hours = $request->hours;
        $shift->rate_per_hour = $request->rate_per_hour;
        $shift->total_pay = (int) ($request->hours * $request->rate_per_hour);
        $shift->taxable = $request->taxable;
        $shift->paid_at = $request->status == 1 ? now() : null;
        $shift->status_id = $request->status;
        $shift->shift_type_id = $request->shift_type;
        $shift->user_id = $request->user;
        $shift->company_id = $request->company;
        $shift->date = $request->date;

        if($shift->save())
            return redirect()->route('shifts.index')->with('success', 'Shift has been updated successfully!');

        return redirect()->route('shifts.index')->with('error', 'Something went wrong, try again.');
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {   
        if($shift->delete())
            return redirect()->route('shifts.index')->with('success', 'Shift deleted successfully!');

        return redirect()->route('shifts.index')->with('error', 'Something went wrong, try again.');
    }

}
